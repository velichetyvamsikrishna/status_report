<nav style="border:1px solid #eee;" class="navbar navbar">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="index.php">Accessibility Status Report</a>
    </div>
    <div class="collapse navbar-collapse" >
	  <ul class="nav navbar-nav">
        <li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Bug Info <span class="caret"></span></a>
		  <ul class="dropdown-menu">
            <li><a onclick="submit_test_results();">Submit Test Details</a></li>
            <li role="separator" class="divider"></li>
			<li><a onclick="modify_update_test_results()">Modify Test Details</a></li>
			<li role="separator" class="divider"></li>
			<li><a onclick="view_test_results()">View Test Details</a></li>
			<li role="separator" class="divider"></li>
			<li><a onclick="tester_status()">View Tester Status</a></li>
			<li role="separator" class="divider"></li>
			<li><a onclick="by_app()">Search By App</a></li>
          </ul>
		</li>
        <li class="dropdown">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Work Allocator <span class="caret"></span></a>
		  <ul class="dropdown-menu">
            <li><a onclick="add_tps();">Add Test Passe's</a></li>
            <li role="separator" class="divider"></li>
			<li><a href="#">Remove Test Passe's</a></li>
			<li role="separator" class="divider"></li>
			<li><a href="#">Add an App</a></li>
          </ul>
		</li>
        <li class="dropdown">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reporter <span class="caret"></span></a>
		  <ul class="dropdown-menu">
            <li><a onclick="reporter();">Make/Update Final Report</a></li>
            <li role="separator" class="divider"></li>
			<li><a href="#">Client View of Final Report</a></li>
          </ul>
		</li>
		<li class="dropdown">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Super Admin<span class="caret"></span></a>
		  <ul class="dropdown-menu">
            <li><a onclick="upload_vso_data();">Upload VSO Data</a></li>
            <li role="separator" class="divider"></li>
			<li><a onclick="view_bugs_table()">View Bugs Table</a></li>
          </ul>
		</li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a onClick="log_out()"><span class="glyphicon glyphicon-log-out"></span> Logout  </a></li>
      </ul>
    </div>
  </div>
</nav>