<?php 

$performing_user = $_SESSION['user'];

?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	 <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/UnixLinuxProject/UnixPhpProject/index.php">Linux Control System</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
            	<li>
            		<a href="/UnixLinuxProject/UnixPhpProject/commands-admin/system_date.php">Current time: <span id="system-time"></span></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo($performing_user); ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="/UnixLinuxProject/UnixPhpProject/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
	<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
	<div class="collapse navbar-collapse navbar-ex1-collapse">
		<ul class="nav navbar-nav side-nav">
			<li>
				<a href="/UnixLinuxProject/UnixPhpProject/index.php"><i class="fa fa-fw fa-home"></i> Home</a>
			</li>
			<li>
				<a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Perl Shell Commands <i class="fa fa-fw fa-caret-down"></i></a>
				<ul id="demo" class="collapse">
					<li>
						<a href="/UnixLinuxProject/UnixPhpProject/commands-perl/ls_command.php">List directory (ls)</a>
					</li>
					<li>
						<a href="/UnixLinuxProject/UnixPhpProject/commands-perl/more_command.php">View file (more)</a>
					</li>
					<li>
						<a href="/UnixLinuxProject/UnixPhpProject/commands-perl/wc_command.php">Print info about counts for file (wc)</a>
					</li>
					<li>
						<a href="/UnixLinuxProject/UnixPhpProject/commands-perl/rm_command.php">Remove file/directory (rm)</a>
					</li>
					<li>
						<a href="/UnixLinuxProject/UnixPhpProject/commands-perl/find_command.php">Search files directory (find)</a>
					</li>
					<li>
						<a href="/UnixLinuxProject/UnixPhpProject/commands-perl/cp_command.php">Copy files and directory (cp)</a>
					</li>

				</ul>
			</li>
			<li>
				<a href="javascript:;" data-toggle="collapse" data-target="#admin"><i class="fa fa-fw fa-user"></i> Administration <i class="fa fa-fw fa-caret-down"></i></a>
				<ul id="admin" class="collapse">
					<li>
						<a href="/UnixLinuxProject/UnixPhpProject/commands-admin/add_user.php">Add User</a>
					</li>
					<li>
						<a href="/UnixLinuxProject/UnixPhpProject/commands-admin/remove_user.php">Remove User</a>
					</li>
					<li>
						<a href="/UnixLinuxProject/UnixPhpProject/commands-admin/edit_user.php">Edit User</a>
					</li>
					<li>
						<a href="/UnixLinuxProject/UnixPhpProject/commands-admin/change_permissions.php">Change Permissions</a>
					</li>
					<li>
						<a href="/UnixLinuxProject/UnixPhpProject/commands-admin/monitor.php">System Monitor</a>
					</li>
					<li>
						<a href="/UnixLinuxProject/UnixPhpProject/commands-admin/system_date.php">Date</a>
					</li>
					<li>
						<a href="/UnixLinuxProject/UnixPhpProject/commands-admin/beckup_restore.php">Beckup/Restore</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="/UnixLinuxProject/UnixPhpProject/file_browser.php"><i class="fa fa-fw fa-folder"></i> File Browser</a>
			</li>
			<li>
				<a href="/UnixLinuxProject/UnixPhpProject/file_editor.php"><i class="fa fa-fw fa-font"></i> File Editor</a>
			</li>
			<li>
				<a href="/UnixLinuxProject/UnixPhpProject/shell_commands.php"><i class="fa fa-fw fa-code"></i> Free Command Line</a>
			</li>
		</ul>
	</div>
	<!-- /.navbar-collapse -->
</nav>