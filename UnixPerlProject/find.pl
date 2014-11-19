#!/usr/bin/perl
use Switch;
use JSON;

use strict;
use warnings;

#my $dirname = $ARGV[0];    #command
my $find = $ARGV[0];    #name of dir/file we want find

my $dirname   = "/";
my @error_arr = ("error");
my $dh;

opendir $dh, $dirname or die print encode_json( \@error_arr );
my @all_files = readdir $dh;
closedir $dh;

foreach my $item (@all_files) {
	if ( $item eq '.' ) {
		next;
	}
	elsif ( $item eq '..' ) {
		next;
	}
	else {

		$item = "/" . $item . "/";
		findFileOrFolder( $item, $find );
	}
}

sub findFileOrFolder {
	my @params            = @_;
	my $current_directory = $params[0];    #current directory
	my $target            = $params[1];    #name of file we want find

	my @temp_files;

	my $dh;

	#print("$current_directory\n");
	#stop condition if its a file
	if ( -f $current_directory ) {
		if ( $target eq $current_directory ) {
			print("$current_directory\n");
			return;
		}
	}

	if ( -d $current_directory ) {
		if ( $target eq $current_directory ) {
			print("$current_directory\n");
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
			if ( $item eq '.' ) {
				next;
			}
			elsif ( $item eq '..' ) {
				next;
			}
			else {
				if ( $item eq $target ) {
					if(-d $item) {
						print($current_directory . $item . "\n");
					}
					else {
						print($current_directory . "/" . $item . "\n");
					}		
				}
				findFileOrFolder( $current_directory . $item, $target );
			}
		}
	}
}

