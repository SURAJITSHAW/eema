<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">REPORTS</li>
      <li class=""><a href="home.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
      <li class=""><a href="votes.php"><span class="glyphicon glyphicon-lock"></span> <span>Overall Count</span></a></li>
      <li class=""><a href="votes-received.php"><span class="glyphicon glyphicon-lock"></span> <span>Member wise votes received</span></a></li>
      <li class=""><a href="vote-completed.php"><span class="glyphicon glyphicon-lock"></span> <span>Completed voting</span></a></li>
      <li class=""><a href="vote-not-started.php"><span class="glyphicon glyphicon-lock"></span> <span>Not started voting</span></a></li>
      <li class=""><a href="vote-not-completed.php"><span class="glyphicon glyphicon-lock"></span> <span>Voting started but not complete</span></a></li>
      <li class="header">MANAGE</li>
      <li class=""><a href="voters.php"><i class="fa fa-users"></i> <span>Voters</span></a></li>
      <li class=""><a href="positions.php"><i class="fa fa-tasks"></i> <span>Positions</span></a></li>
      <li class=""><a href="candidates.php"><i class="fa fa-black-tie"></i> <span>Candidates</span></a></li>
        
        <li class=""><a href="voters-ip.php"><i class="fa fa-cog"></i> <span>Voter IP Address</span></a></li>
<!--
      <li class="header">SETTINGS</li>
      <li class=""><a href="ballot.php"><i class="fa fa-file-text"></i> <span>Ballot Position</span></a></li>
      <li class=""><a href="#config" data-toggle="modal"><i class="fa fa-cog"></i> <span>Election Title</span></a></li>
-->
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
<?php include 'config_modal.php'; ?>