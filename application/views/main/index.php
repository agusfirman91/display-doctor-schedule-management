<h1 class="text-center text-danger">
  Welcome to Management Display Application
</h1>
<div class="row">
  <div class="col-lg-6 col-xl-3 d-flex">
    <div class="card flex-fill">
      <div class="card-header">
        <span class="badge badge-primary float-right">Today</span>
        <h5 class="card-title mb-0">Users</h5>
      </div>
      <div class="card-body my-2">
        <div class="row d-flex align-items-center mb-4">
          <div class="col-8">
            <h2 class="d-flex align-items-center mb-0 font-weight-light">
              $37.500
            </h2>
          </div>
          <div class="col-4 text-right">
            <span class="text-muted">57%</span>
          </div>
        </div>

        <div class="progress progress-sm shadow-sm mb-1">
          <div class="progress-bar bg-primary" role="progressbar" style="width: 57%"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-6 col-xl-3 d-flex">
    <div class="card flex-fill">
      <div class="card-header">
        <span class="badge badge-warning float-right">Annual</span>
        <h5 class="card-title mb-0">Orders</h5>
      </div>
      <div class="card-body my-2">
        <div class="row d-flex align-items-center mb-4">
          <div class="col-8">
            <h2 class="d-flex align-items-center mb-0 font-weight-light">
              3.282
            </h2>
          </div>
          <div class="col-4 text-right">
            <span class="text-muted">82%</span>
          </div>
        </div>

        <div class="progress progress-sm shadow-sm mb-1">
          <div class="progress-bar bg-warning" role="progressbar" style="width: 82%"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-6 col-xl-3 d-flex">
    <div class="card flex-fill">
      <div class="card-header">
        <span class="badge badge-info float-right">Monthly</span>
        <h5 class="card-title mb-0">Activity</h5>
      </div>
      <div class="card-body my-2">
        <div class="row d-flex align-items-center mb-4">
          <div class="col-8">
            <h2 class="d-flex align-items-center mb-0 font-weight-light">
              19.312
            </h2>
          </div>
          <div class="col-4 text-right">
            <span class="text-muted">64%</span>
          </div>
        </div>

        <div class="progress progress-sm shadow-sm mb-1">
          <div class="progress-bar bg-info" role="progressbar" style="width: 64%"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-6 col-xl-3 d-flex">
    <div class="card flex-fill">
      <div class="card-header">
        <span class="badge badge-success float-right">Yearly</span>
        <h5 class="card-title mb-0">Revenue</h5>
      </div>
      <div class="card-body my-2">
        <div class="row d-flex align-items-center mb-4">
          <div class="col-8">
            <h2 class="d-flex align-items-center mb-0 font-weight-light">
              $82.400
            </h2>
          </div>
          <div class="col-4 text-right">
            <span class="text-muted">32%</span>
          </div>
        </div>

        <div class="progress progress-sm shadow-sm mb-1">
          <div class="progress-bar bg-success" role="progressbar" style="width: 32%"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<h5>Workflow Application</h5>
<div id="smartwizard-arrows-primary" class="wizard wizard-primary mb-4 sw-main sw-theme-arrows">
  <ul class="nav nav-tabs step-anchor">
    <li class="nav-item active"><a href="#arrows-primary-step-1" class="nav-link">Create Master Dokter<br><small>Step description</small></a></li>
    <li class="nav-item"><a href="#arrows-primary-step-2" class="nav-link">Create Master Perawat<br><small>Step description</small></a></li>
    <li class="nav-item"><a href="#arrows-primary-step-3" class="nav-link">Create Master Ruang Dokter<br><small>Step description</small></a></li>
    <li class="nav-item"><a href="#arrows-primary-step-4" class="nav-link">Step Title<br><small>Step description</small></a></li>
  </ul>

  <div class="sw-container tab-content" style="min-height: 61px;">
    <div id="arrows-primary-step-1" class="tab-pane step-content" style="display: block;">
      Step Content 1
    </div>
    <div id="arrows-primary-step-2" class="tab-pane step-content">
      Step Content 2
    </div>
    <div id="arrows-primary-step-3" class="tab-pane step-content">
      Step Content 3
    </div>
    <div id="arrows-primary-step-4" class="tab-pane step-content">
      Step Content 4
    </div>
  </div>
</div>

<table class="table table-striped display" id="tableData" cellspacing="0" width="100%">
  <thead>
    <th>Name</th>
    <th>Image Icon</th>
    <th>Image Display</th>
    <th>Active</th>
    <th>Action</th>
  </thead>
</table>

<script>
  $(function() {
    $("#smartwizard-arrows-primary").smartWizard({
      theme: "arrows",
      showStepURLhash: false
    });
  });
</script>