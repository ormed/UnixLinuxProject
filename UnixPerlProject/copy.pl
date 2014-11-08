#!/usr/bin/perl
use strict;
use warnings;

use Switch;
use JSON;
use File::Copy

my $command = $ARGV[0];    #command
my $dirname = $ARGV[1];    #path for dir
my $cp_dirname = $ARGV[2]; #path to copy dir

my @error_arr = ("wc: $dirname: No such file or directory");
open my ($dh), $dirname or die print encode_json( \@error_arr );

recursiveFolderTree($dh, $path);



sub recursiveFolderTree {
	my @params = @_;
	my $file_handler = @params[0];
	
	if ( -f $file_handler ) {
		copy()
	}
}

