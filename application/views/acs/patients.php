<!-- MY App -->
<script src="<?= base_url() ?>app/packages/dirPagination.js"></script>
<script src="<?= base_url() ?>app/services/myServices.js"></script>
<script src="<?= base_url() ?>app/helper/myHelper.js"></script>

<div ng-app="myApp" ng-controller="pasienCtrl">
    <div class="card" style="margin-top:75px">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h1>List Pasien</h1>
                    </div>
                    <div class="input-group mt-3 col-3 float-right">
                        <input type="text" class="form-control" ng-change="searchDB()" ng-model="searchText" name="table_search" title="" tooltip="" data-original-title="Min character length is 3">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button">Search</button>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered pagin-table mt-2">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No RM</th>
                        <th>No Registrasi</th>
                        <th>Nama Pasien</th>
                        <th>Nama Suku</th>
                        <th>Nama Agama</th>
                        <th width="220px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-if="post.length == 0">
                        <td colspan="4" class="text-center">tidak ada data</td>
                    </tr>
                    <tr id="post-array" dir-paginate="x in patients | orderBy: 'no_rm'| itemsPerPage:5" total-items="totalPatients">
                        <!-- | pagination: curPage * pageSize | limitTo: pageSize -->
                        <td>{{ $index + 1 }}</td>
                        <td>{{ x.no_rm }}</td>
                        <td>{{ x.no_reg }}</td>
                        <td>{{ x.nama }}</td>
                        <td>{{ x.agama }}</td>
                        <td>{{ x.suku }}</td>
                        <td>
                            <button data-toggle=" modal" ng-click="edit($index)" class="btn btn-primary">Edit</button>
                            <button ng-click="delete($index)" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <a href="<?= base_url() ?>acs" class="btn btn-danger">Back</a>
            <button class="btn btn-primary" data-toggle="modal" data-target="#form-patient">Create New</button>
        </div>
    </div>

    <dir-pagination-controls class="pull-right" on-page-change="pageChanged(newPageNumber)" template-url="_partials/dirPagination.html"></dir-pagination-controls>

    <div id="form-patient" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Pasien</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="alert alert-danger" ng-if="errors.length > 0">
                        <li ng-repeat="error in errors">{{ error }}</li>
                    </ul>
                    <div class="form-group">
                        <label for="no_rm">No Rekam Medis</label>
                        <input type="hidden" ng-model="patient.id">
                        <input ng-model="patient.no_rm" type="text" class="form-control" placeholder="NO Rekam Medis" />
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input ng-model="patient.nama" type="text" class="form-control" placeholder="Nama" />
                    </div>
                    <div class="form-group">
                        <label for="no_reg">No Registrasi</label>
                        <input ng-model="patient.no_reg" type="text" class="form-control" placeholder="No Registrasi" />
                    </div>
                    <div class="form-group">
                        <label for="idsuku">Suku</label>
                        <select class="form-control" ng-model="patient.idsuku">
                            <option value="">Pilih</option>
                            <option ng-repeat="opt in suku" value="{{opt.idsuku}}">{{opt.suku}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="idagama">Agama</label>
                        <select class="form-control" ng-model="patient.idagama">
                            <option value="">Pilih</option>
                            <option ng-repeat="opt in agama" value="{{opt.idagama}}">{{opt.agama}}</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" ng-click="addPatient()" ng-disabled="disabledAdd">Simpan</button>
                    <button type="button" class="btn btn-info" ng-click="updatePatient()" ng-disabled="disabledUpdate">Ubah</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>


</div>

<script>
    var app = angular.module('myApp', ['angularUtils.directives.dirPagination']);

    app.controller('pasienCtrl', function(dataFactory, $scope, $http) {

        $scope.errors = [];
        $scope.patients = []; //List Produk
        $scope.patient = {}; //Object
        $scope.suku;
        $scope.agama;
        $scope.message = "";
        $scope.disabledAdd = false;
        $scope.disabledUpdate = true;
        $scope.pageNumber = 1;
        $scope.libraryTemp = {};
        $scope.totalPatientsTemp = {};
        $scope.totalPatients = 0;
        $scope.pageChanged = function(newPage) {
            getResultsPage(newPage);
        };
        getResultsPage(1);


        $scope.searchDB = function() {
            if ($scope.searchText.length >= 3) {
                if ($.isEmptyObject($scope.libraryTemp)) {
                    $scope.libraryTemp = $scope.data;
                    $scope.totalPatientsTemp = $scope.totalPatients;
                    $scope.data = {};
                }
                getResultsPage(1);
            } else {
                if (!$.isEmptyObject($scope.libraryTemp)) {
                    $scope.data = $scope.libraryTemp;
                    $scope.totalPatients = $scope.totalPatientsTemp;
                    $scope.libraryTemp = {};
                }
            }
        }


        $scope.getSuku = function() {
            $http({
                method: 'GET',
                url: '<?= base_url('acs/getSuku/ ') ?>'
            }).then(function success(e) {
                $scope.suku = e.data;
            }, function error(e) {
                console.log(e.data, e.error);
            });
        };

        $scope.getSuku();


        $scope.getAgama = function() {
            $http({
                method: 'GET',
                url: '<?= base_url('acs/getAgama/ ') ?>'
            }).then(function success(e) {
                $scope.agama = e.data;
            }, function error(e) {
                console.log(e.data, e.error);
            });
        };

        $scope.getAgama();

        $scope.getPatient = function() {
            $http({
                method: 'GET',
                url: '<?= base_url('acs/get_all') ?>'
            }).then(function succes(e) {
                $scope.patients = e.data;
            }, function error(e) {
                console.log(e.data, e.error);
            });
        };

        $scope.addPatient = function() {
            // console.log($scope.patient);
            $http({
                method: 'POST',
                url: '<?= base_url('acs/insert/') ?>',
                data: {
                    patient: $scope.patient
                }
            }).then(function success(e) {
                $scope.errors = [];
                $scope.patients.push(e.data.patient);
                var modal_element = angular.element('#form-patient');
                modal_element.modal('hide');
                toastr.info('Data Berhasil Di Tambahkan', 'Information', {
                    timeOut: 3000
                });
            }, function error(e) {
                $scope.errors = e.data.errors;
            });
        }

        $scope.edit = function(index) {
            console.log(index)
            $scope.patient = $scope.patients[index];
            $scope.disabledAdd = true;
            $scope.disabledUpdate = false;
            var modal_element = angular.element('#form-patient');
            modal_element.modal('show');
        };

        $scope.updatePatient = function() {
            // console.log($scope.patient);
            $http({
                method: 'POST',
                url: '<?= base_url('acs/update/') ?>',
                data: {
                    patient: $scope.patient
                }
            }).then(function success(e) {
                $scope.errors = [];
                var modal_element = angular.element('#form-patient');
                modal_element.modal('hide');
                toastr.info('Data Berhasil Diubah', 'Information', {
                    timeOut: 3000
                });
            }, function error(e) {
                $scope.errors = e.data.errors;
            });
        }


        $scope.delete = function(id) {
            var conf = confirm("Yakin mau menghapus !!");
            if (conf == true) {
                $http({
                    method: 'POST',
                    url: '<?php echo site_url('acs/delete/') ?>',
                    data: {
                        ID: id
                    }
                }).then(function success(e) {
                    $scope.patients.splice($scope.patients.indexOf($scope.patients));
                    toastr.info('Data Berhasil Dihapus', 'Information', {
                        timeOut: 3000
                    });
                }, function error(e) {
                    $scope.errors = e.data.errors;
                    console.log(e.data, e.errors);
                });
            }
        }

        $scope.getPatient();
    });

    // alert('ok');
</script>