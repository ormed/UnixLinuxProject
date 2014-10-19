#!/usr/bin/perl
use Switch;
use JSON;
use File::stat;
use Time::localtime;

$command = $ARGV[0];    #command
$dirname = $ARGV[1];    #path for dir

opendir my ($dh), $dirname or die "Couldn't open dir '$dirname': $!";

switch ($command) {
	case "-a" {

		#ls -a
		my @files = readdir $dh;
		closedir $dh;

		@sorted_files = sort @files;
		print encode_json( \@sorted_files );
	}
	case "-l" {

		#ls -l
		my @files = readdir $dh;
		closedir $dh;

		@sorted_files = sort @files;

		#print encode_json( \@sorted_files );
		my $str         = "";
		my $permissions = "-";
		my $count = 0;
		foreach $item (@sorted_files) {
			if ( -x $item && !-d $item )
			{    # if file is executable and not directory
				$sb = stat($item);
				if ( -r $item ) {
					$permissions = $permissions . "r";
				}
				else {
					$permissions = $permissions . "-";
				}
				if ( -w $item ) {
					$permissions = $permissions . "w";
				}
				else {
					$permissions = $permissions . "-";
				}
				$permissions = $permissions . "x------";    #fix it

				my $nlink = $sb->nlink;

				my $uid  = ( stat $item )[4];               #number of user
				my $user = ( getpwuid $uid )[0];            #name of user

				my $gid   = ( stat $item )[4];              #number of group
				my $group = ( getpwuid $gid )[0];           #name of group
				
				my $size = -s $item;

				my $date = ctime( $sb->atime );

				$str =
				  $str . "$permissions $nlink $user $group $size $date $item \n";
			}
			$count++;
		}
		print "total $count\n";
		print $str;
	}
	else {

		#ls
		my @files = grep { !/^\./ } readdir $dh;
		closedir $dh;

		@sorted_files = sort @files;
		print encode_json( \@sorted_files );
	}
}

print "\n";

