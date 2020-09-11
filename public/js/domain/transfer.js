var cariUserUrl = $('#cariUserUrl').val();
/**
 * Cari user bedasarkan email atau integra
 * @param {string} key search bedasarkan 'email' atau 'integra'
 */
function cariUser(key) {
    const value = $(`#${key}`).val();
    const request = $.get(cariUserUrl, { [key]: value })
        .done(function (result) {
            const user = JSON.parse(result);
            $('#email').val(user.email);
            $('#userId').val(user.id);
            $('#integra').val(user.integra);
            $('#nama').val(user.nama);
            $('#no_wa').val(user.no_wa);
        })
        .fail(function () {
            alert('User tidak ditemukan! User peimilik baru harus pernah login'
                + ' ke simdom terlebih dahulu! Data user sesuai dengan data yang'
                + ' ada di MyITS!');
        });
}

function submitTransferForm() {
    // Validasi frontend
    if (!$('#userId').val()) {
        alert('Pilih user untuk menjadi pemilik baru!');
        return;
    }
    if ($('#userId').val() == $('#pemilikId').val()) {
        alert('Pilih user yang bukan diri anda sendiri!');
        return;
    }

    if (!confirm('Apakah anda yakin untuk menyerahkan domain?')) { return; }
    if (!confirm('Warning! this action cannot be undone!')) { return; }
    $('#formElm').submit();
}