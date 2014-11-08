#!/usr/bin/perl
use Switch;

use strict;
use warnings;

my $command = $ARGV[0];    #command
my $dirname = $ARGV[1];    #path for dir

my @error_arr = ("ls: cannot access $dirname: No such file or directory");
opendir my ($dh), $dirname or die print encode_json( \@error_arr );

my @all_files      = readdir $dh;
closedir $dh;

switch ($command) {
	case "-a" {

	}

	else {

		# rm
		foreach my $file (@all_files) {
			unlink $file or warn "Could not unlink $file: $!";
		}
	}
}

