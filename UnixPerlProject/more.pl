#!/usr/bin/perl
use strict;
use warnings;

use Switch;
use JSON;
use File::stat;

my $command = $ARGV[0];    #command
my $dirname = $ARGV[1];    #path for dir

my @error_arr = ("$dirname: No such file or directory");
open my ($dh), $dirname or die print encode_json( \@error_arr );

if ( -d $dh ) {
	my @error_arr = ("*** $dirname: directory ***");
	print encode_json( \@error_arr );
	exit;
}

switch ($command) {
	case "-a" {

	}
	else {
		my $text_file = do { local $/; <$dh> };
		my @result = ($text_file);
		print encode_json( \@result );
	}
}

close $dh;
