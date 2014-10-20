#!/usr/bin/perl
use Switch;
use JSON;
use File::stat;
use Time::localtime;
use Fcntl ':mode';
use 5.010;

use warnings;

$command = $ARGV[0];    #command
$dirname = $ARGV[1];    #path for dir

opendir my ($dh), $dirname or die "Couldn't open dir '$dirname': $!";

@all_files = readdir $dh;
@unhidden_files = grep { !/^\./ } @all_files;

closedir $dh;

switch ($command) {
	case "-a" {

		#ls -a
		@sorted_files = sort @all_files;
		print encode_json( \@sorted_files );
	}
	case "-l" {    # fix print all files

		#ls -l

		@sorted_files = sort @unhidden_files;

		my $count = 0;
		my $str   = "";
		my $info  = "";
		@arrOfStrFiles = ();
		foreach $item (@sorted_files) {
			$str .= getFileInformation($item);
			$count++;
		}
		$str = "total $count\n" . $str;
		@arrOfStrFiles = split( '\n', $str );
		print encode_json( \@arrOfStrFiles );

	}
	case "-al" {

		#ls -al

		@sorted_files = sort @all_files;

		my $count = 0;
		my $str   = "";
		foreach $item (@sorted_files) {
			$str .= getFileInformation($item);
			$count++;
		}
		$str = "total $count\n" . $str;
		@arrOfStrFiles = split( '\n', $str );
		print encode_json( \@arrOfStrFiles );
	}
	else {

		#ls
		@sorted_files = sort @unhidden_files;
		print encode_json( \@sorted_files );
	}
}

sub getPermissions {
	$permissions = "";
	foreach $item (@_) {
		if ( $item == 0 ) {
			$permissions = $permissions . "---";
		}
		elsif ( $item == 1 ) {
			$permissions = $permissions . "--x";
		}
		elsif ( $item == 2 ) {
			$permissions = $permissions . "-w-";
		}
		elsif ( $item == 3 ) {
			$permissions = $permissions . "-wx";
		}
		elsif ( $item == 4 ) {
			$permissions = $permissions . "r--";
		}
		elsif ( $item == 5 ) {
			$permissions = $permissions . "r-x";
		}
		elsif ( $item == 6 ) {
			$permissions = $permissions . "rw-";
		}
		elsif ( $item == 7 ) {
			$permissions = $permissions . "rwx";
		}
	}

	return $permissions;
}

sub getFileInformation {
	my $str         = "";
	my $permissions = "-";
	my $sb;
	foreach $item (@_) {

		$sb = stat($item);

		my $mode = $sb->mode & 07777;
		my $usr  = ( $mode & 0700 ) >> 6;        #mode of user
		my $grp  = ( $mode & 0070 ) >> 3;        #mode of group
		my $oth  = $mode & 0007;                 #mode of others

		$permissions .= getPermissions( $usr, $grp, $oth );

		my $nlink = $sb->nlink;

		my $uid  = $sb->uid;            #number of user
		my $user = ( getpwuid $uid )[0];         #name of user

		my $gid   = $sb->gid;           #number of group
		my $group = ( getpwuid $gid )[0];        #name of group

		my $size = $sb->size;            #size of file

		my $date = ctime( $sb->atime );

		$str .= "$permissions $nlink $user $group $size $date $item \n";
	}
	return $str;
}

