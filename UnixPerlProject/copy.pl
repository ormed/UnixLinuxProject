#!/usr/bin/perl
use strict;
use warnings;

use Switch;
use JSON;

my $command = $ARGV[0];    #command
my $dirname = $ARGV[1];    #path for dir

my @error_arr = ("wc: $dirname: No such file or directory");
open my ($dh), $dirname or die print encode_json( \@error_arr );

open FILE, ">", "file.txt" or die $!;
my $text_file = do { local $/; <$dh> };

switch ($command) {
	case "-r" {
		print FILE $text_file;
	}

	else {
		print FILE $text_file;
	}
}
close FILE;
