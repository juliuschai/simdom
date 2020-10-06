let $data = $('#serverData');

var perbulan = $data.data('perbulan');
var nama_bulan = $data.data('nama_bulan');

var pertahun = $data.data('pertahun');
var nama_tahun = $data.data('nama_tahun');

var departements = $data.data('departements');
var nama_departemen = $data.data('nama_departemen');

var faculties = $data.data('faculties');
var nama_fakultas = $data.data('nama_fakultas');

var units = $data.data('units');
var nama_unit = $data.data('nama_unit');

var servers_WHS = $data.data('servers_WHS');
var servers_VPS = $data.data('servers_VPS');
var servers_Colocation = $data.data('servers_Colocation');

var all = document.getElementById('perbulan').getContext('2d');
var chart = new Chart(all, {
type: 'line',
data: {
    labels: nama_bulan,
    datasets: [{
            label: '',
            data: perbulan
    }]
},
options: {
    legend: {
        display: false,
    },
    scales: {
        xAxes: [{
            barPercentage: 0.6,
            ticks: {
                maxRotation: 90
            },
            gridLines: {
                display: false,
            }
        }],
        yAxes: [{
            display: true,
            ticks: {
                maxTicksLimit: 5
            },
            gridLines: {
                display: true,
                color: '#D8D8D8'
            }
        }]
    },
    plugins: {
        datalabels: {
            display: false
        },
        colorschemes: {
            scheme: 'brewer.BrBG7'
        }
    }
}
});

var all = document.getElementById('pertahun').getContext('2d');
var chart = new Chart(all, {
type: 'line',
data: {
    labels: nama_tahun,
    datasets: [{
            label: '',
            data: pertahun
    }]
},
options: {
    legend: {
        display: false,
    },
    scales: {
        xAxes: [{
            barPercentage: 0.6,
            ticks: {
                maxRotation: 90
            },
            gridLines: {
                display: false,
            }
        }],
        yAxes: [{
            display: true,
            ticks: {
                maxTicksLimit: 5
            },
            gridLines: {
                display: true,
                color: '#D8D8D8'
            }
        }]
    },
    plugins: {
        datalabels: {
            display: false
        },
        colorschemes: {
            scheme: 'brewer.RdBu9'
        }
    }
}
});

var all = document.getElementById('departemen').getContext('2d');
var chart = new Chart(all, {
type: 'bar',
data: {
    labels: nama_departemen,
    datasets: [{
            label: '',
            data: departements
    }]
},
options: {
    legend: {
        display: false,
    },
    scales: {
        xAxes: [{
            barPercentage: 0.6,
            ticks: {
                maxRotation: 90
            },
            gridLines: {
                display: false,
            }
        }],
        yAxes: [{
            display: true,
            ticks: {
                maxTicksLimit: 5
            },
            gridLines: {
                display: true,
                color: '#D8D8D8'
            }
        }]
    },
    plugins: {
        datalabels: {
            display: false
        },
        colorschemes: {
            scheme: 'brewer.PRGn6'
        }
    }
}
});

var all = document.getElementById('fakultas').getContext('2d');
var chart = new Chart(all, {
type: 'bar',
data: {
    labels: nama_fakultas,
    datasets: [{
            label: '',
            data: faculties
    }]
},
options: {
    legend: {
        display: false,
    },
    scales: {
        xAxes: [{
            barPercentage: 0.6,
            ticks: {
                maxRotation: 90
            },
            gridLines: {
                display: false,
            }
        }],
        yAxes: [{
            display: true,
            ticks: {
                maxTicksLimit: 5
            },
            gridLines: {
                display: true,
                color: '#D8D8D8'
            }
        }]
    },
    plugins: {
        datalabels: {
            display: false
        },
        colorschemes: {
            scheme: 'brewer.RdBu7'
        }
    }
}
});

var all = document.getElementById('unit').getContext('2d');
var chart = new Chart(all, {
type: 'bar',
data: {
    labels: nama_unit,
    datasets: [{
            label: '',
            data: units
    }]
},
options: {
    legend: {
        display: false,
    },
    scales: {
        xAxes: [{
            barPercentage: 0.6,
            ticks: {
                maxRotation: 90
            },
            gridLines: {
                display: false,
            }
        }],
        yAxes: [{
            display: true,
            ticks: {
                maxTicksLimit: 5
            },
            gridLines: {
                display: true,
                color: '#D8D8D8'
            }
        }]
    },
    plugins: {
        datalabels: {
            display: false
        },
        colorschemes: {
            scheme: 'brewer.Paired5'
        }
    }
}
});

var all = document.getElementById('server').getContext('2d');
var chart = new Chart(all, {
type: 'doughnut',
data: {
    labels: ['WHS', 'VPS', 'Colocation'],
    datasets: [{
        label: '',
        data: servers_WHS
    }, {
        data: servers_VPS
    },{
        data: servers_Colocation
    }]
},
options: {
    legend: {
        display: false,
    },
    scales: {
        xAxes: [{
            barPercentage: 0.6,
            ticks: {
                maxRotation: 90
            },
            gridLines: {
                display: false,
            }
        }],
        yAxes: [{
            display: true,
            ticks: {
                maxTicksLimit: 5
            },
            gridLines: {
                display: true,
                color: '#D8D8D8'
            }
        }]
    },
    plugins: {
        datalabels: {
            display: false
        },
        colorschemes: {
            scheme: 'brewer.PastelOne4'
        }
    }
}
});

console.log("bisa");