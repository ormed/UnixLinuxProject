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
	
	my @path_array = split( '/', $current_directory );    #split the copy_to path inorder to get only the file name
	my $new_dir = $path_array[$#path_array];
	
	#stop condition if its a file
	if ( -f $current_directory ) {
		if ( $new_dir eq $target ) {
			return;
		}
	}

	if ( -d $current_directory ) {
		if ( $new_dir eq $target ) {
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
				#my @path_array = split( '/', $current_directory );    #split the copy_to path inorder to get only the file name
				#my $new_dir = $path_array[$#path_array];
				
				if ( $item eq $target ) {
					#print("dir = $item\n");
					#print("current_directory = $current_directory\n");
					if(-d $current_directory.$item) {
						print($current_directory . "/" . $target . "/\n");
						#print("dir\n");
					}
					else {
						print($current_directory . "/" . $target . "\n");
						#print("file\n");
					}		
				}
				findFileOrFolder( $current_directory . $item, $target );
			}
		}
	}
}

