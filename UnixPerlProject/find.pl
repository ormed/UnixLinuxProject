#!/usr/bin/perl
use Switch;
use JSON;

use strict;
use warnings;

my $dirname = $ARGV[0];    #command
my $find    = $ARGV[1];    #name of dir/file we want find

#my $dirname   = "~";
my @error_arr = ("error");

open my $dh, $dirname or die print encode_json( \@error_arr );

closedir $dh;

findFileOrFolder( $dh, $find );

sub fineFileOrFolder {
	my @params            = @_;
	my $current_directory = $params[0];    #current directory
	my $target            = $params[1];    #name of file we want find

	my @temp_files;

	#stop condition if its a file
	if ( -f $current_directory ) {
		if ( $target eq $current_directory ) {
			print($current_directory);
			return;
		}
	}

	if ( -d $current_directory ) {
		if ( $target eq $current_directory ) {
			printf($current_directory);
		}
		opendir $dh, $current_directory or die print( \@error_arr );
		@temp_files = readdir $dh;
		close $dh;

		# safety - stopping condition if we reached an empty folder.
		my $size = $#temp_files;
		if ( $size == 0 ) {
			return;
		}

		foreach my $item (@temp_files) {
			if ( $item eq '..' ) {
				next;
			}
			else {
				fineFileOrFolder( $current_directory, $target );
			}
		}
	}
}

