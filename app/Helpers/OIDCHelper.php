<?php

namespace App\Helpers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Its\Sso\OpenIDConnectClient;
use Its\Sso\OpenIDConnectClientException;

class OIDCHelper extends OpenIDConnectClient {
	static function OIDLogin() {
		try {
			$oidc = new OpenIDConnectClient(
				env('OIDC_PROVIDER'), // authorization_endpoint
				env('OIDC_CLIENT_ID'), // Client ID
				env('OIDC_CLIENT_SECRET') // Client Secret
			);
			$oidc->setRedirectURL(env('OIDC_LOGIN_REDIRECT')); // must be the same as you registered
			$oidc->addScope(env('OIDC_SCOPE')); //must be the same as you registered

			// PROD: Remove
			$oidc->setVerifyHost(false);
			$oidc->setVerifyPeer(false);

			/* if oidc authenticate throws any errors, and i mean ANY ERRORS, 
			retry the user's login. Might result in infinite redirects */
			try {
				$oidc->authenticate(); //call the main function of myITS SSO login
			} catch (\Throwable $th) {
				\Log::warning('There was an error with $oidc->authenticate()');
				\Log::warning($th);
				return redirect()->route('login');
			}
			session(['id_token' => $oidc->getIdToken()]);
			session()->save();

			return $oidc;
		} catch (OpenIDConnectClientException $e) {
			\Log::error('OIDC login err: '.$e->getMessage());
		}

		return null;
	}

	static function login() {
		Auth::loginUsingId(1);
		return;
		// Only run if user is not logged in
		$oidc = OIDCHelper::OIDLogin();
		if (!$oidc || !method_exists($oidc, 'requestUserInfo')) {
			return redirect()->route('login');
		}
        $attr = $oidc->requestUserInfo();
		$user = User::where('sub', $attr->sub)->first();
		if (!$user) $user = new User();

		$user->sub = $attr->sub;
		if (!$attr->email) {
			abort(403, 'Primary Email harus diisi, Update Primary Email dari menu Settings myITS SSO');
		}
		$user->email = $attr->email;
		$user->nama = $attr->name;
		$user->integra = $attr->reg_id;
		if (!$attr->phone) {
			abort(403, 'No. WA harus diisi, Update No. WA dari menu Settings myITS SSO');
		}
		$user->no_wa = $attr->phone;
		$groupStr = OIDCHelper::groupToString($attr->group);
		$user->group = $groupStr;
		$user->save();

        Auth::loginUsingId($user->id);
	}

	static function logout() {
		try {
			if (session()->has('id_token')) {
				Auth::logout();
				$accessToken = session('id_token');
				session()->forget('id_token');
				session()->save();

				$oidc = new OpenIDConnectClient(
					env('OIDC_PROVIDER'), // authorization_endpoint
					env('OIDC_CLIENT_ID'), // Client ID
					env('OIDC_CLIENT_SECRET') // Client Secret
				);
		
				// PROD: Remove
				$oidc->setVerifyHost(false);
				$oidc->setVerifyPeer(false);

				// Ask if user also wants to quit from myitssso
				$oidc->signOut($accessToken, env('OIDC_LOGOUT_REDIRECT'));
			}

			header("Location: " . env('OIDC_LOGOUT_REDIRECT'));
		} catch (OpenIDConnectClientException $e) {
			\Log::error('OIDC logout err: '.$e->getMessage());
		}
	}

	/**
	 * Function to parse group from requestUserInfo into a
	 * comma seperated imploded string
	 */
	static function groupToString($groups) {
		$group_names = [];
		foreach ($groups as $group) {
			if ($group->group_name == 'Everyone') {
				continue;
			} else {
				$group_names[] = $group->group_name;
			}
		}
		sort($group_names);
		$ret = implode(",", $group_names);
		return $ret;
	}
}
