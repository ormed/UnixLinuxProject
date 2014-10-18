#!/usr/bin/perl
use Switch;
use JSON;

$command = $ARGV[0];    #command
$dirname = $ARGV[1];    #path for dir

switch ($command) {
	case "-a" {
		#ls -a
		opendir my ($dh), $dirname or die "Couldn't open dir '$dirname': $!";
		my @files = readdir $dh;
		closedir $dh;

		print encode_json(@files);
	}
	else { print "Not ls command" }
}

