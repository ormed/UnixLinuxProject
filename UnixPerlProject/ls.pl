#!/usr/bin/perl
use Switch;
use JSON;
use File::stat;

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
	else {

		#ls
		my @files = grep { !/^\./ } readdir $dh;
		closedir $dh;

		@sorted_files = sort @files;
		print encode_json( \@sorted_files );
	}
}

print "\n";

