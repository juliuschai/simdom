function initTable() {
    $('#showTableButton').hide();
    $('#ipTableSection').show();

    // domain list datatabel setup
    var $tableElm = $('#tableElm');

    var $useIpBtn = $(`
    <button type="button" onclick="useIp(this.dataset.ip)" 
        class="btn btn-primary">Pakai IP</button>
    `);

    var datatableRes = $tableElm.DataTable({
        dom: 'lrtip',
        processing: true,
        serverSide: true,
        ajax: $tableElm.data('ajaxurl'),
        columns: [
            {
                title: 'Id',
                data: 'id',
                name: 'domains.id',
                searchable: false,
                visible: false,
            },
            {
                title: 'Unit',
                data: 'unit_id',
                name: 'units.id',
                searchable: true,
                visible: false,
            },
            {
                title: 'Server',
                data: 'server',
                name: 'domains.server',
                searchable: true,
                visible: false,
            },
            {
                title: 'Status',
                data: 'aktif',
                name: 'domains.aktif',
                searchable: true,
                visible: false,
            },
            {
                title: 'Domain',
                data: 'alias',
                name: 'domains.alias',
                searchable: true,
                visible: true,
                render: function (data, type, full, meta) {
                    const res = data.replace(',', ',<br>');
                    return res;
                }
            },
            {
                title: 'Kapasitas DB',
                data: 'kapasitas',
                name: 'domains.kapasitas',
                searchable: true,
                visible: true,
            },
            {
                title: 'IP',
                data: 'ip',
                name: 'domains.ip',
                searchable: true,
                visible: true,
            },
            {
                title: 'Aksi',
                data: null,
                name: null,
                searchable: false,
                visible: true,
                render: function (data, type, full, meta) {
                    const useIpBtn = $useIpBtn.clone().get(0);
                    useIpBtn.dataset.ip = full.ip;
                    return useIpBtn.outerHTML;
                }
            }
        ],
    });

    datatableRes.columns('units.id:name').search($tableElm.data('unit'));
    datatableRes.columns('domains.server:name').search($tableElm.data('server'));
    datatableRes.columns('domains.aktif:name').search($tableElm.data('aktif'));
    datatableRes.draw();
}

function useIp(ip) {
    $('#ip').val(ip);
}
