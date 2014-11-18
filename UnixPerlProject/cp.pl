#!/usr/bin/perl
use Switch;
use JSON;

use strict;
use warnings;

my $command = $ARGV[0];    #command
my $dirname = $ARGV[1];    #path for dir we want copy
my $target  = $ARGV[2];    #path to copy dir

my @error_arr = ("cp: cannot stat $dirname : No such file or directory");

open my ($df), $dirname or die print encode_json( \@error_arr );

my $dh;

if ( -f $df ) {
	copyFileText( $dirname, $target );
	exit;
}

opendir $dh, $dirname or die print encode_json( \@error_arr );
my @all_files = readdir $dh;
my @un_dotted_files = grep { !/^\.\./ } @all_files;
closedir $dh;

copyFolderContent( $dirname, $target );

if ( $#un_dotted_files > 0 ) {

	my @path_array =
	  split( '/', $dirname )
	  ;    #split the copy_to path inorder to get only the file name
	my $new_dir = $target . '/' . $path_array[$#path_array];

	mkdir $new_dir;

	foreach my $item (@un_dotted_files) {
		if ( $item eq '.' ) {
			next;
		}
		elsif ( $item eq '..' ) {
			next;
		}
		else {
		}
	}
}
else {

}

sub copyFolderContent {
	my @params            = @_;
	my $current_directory = $params[0];    #folder/file we want to copy
	my $target            = $params[1];

	#stop condition if its a file
	if ( -f $current_directory ) {

#my $up_directory =~ s/\/([\x00-\x2E\x30-\x7F]+)$/\//g;	# remove file name from path
		copyFileText( $current_directory, $target );
		return;
	}

	if ( -d $current_directory ) {

		my @path_array =
		  split( '/', $current_directory )
		  ;    #split the copy_to path inorder to get only the file name
		my $new_dir = $target . '/' . $path_array[$#path_array];
		mkdir $new_dir;    #create dir for copying

		opendir $dh, $current_directory or die print( \@error_arr );
		my @temp_files = readdir $dh;
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
				copyFolderContent( $current_directory . '/' . $item, $new_dir );
			}
		}

		return;
	}
}

sub copyFileText {
	my @params    = @_;
	my $copy_from = $params[0];    #file we want to copy
	my $copy_to   = $params[1];    #the folder we want to copy file to

	my @path_array =
	  split( '/', $copy_from )
	  ;    #split the copy_to path inorder to get only the file name

	my $new_file = $copy_to . '/' . $path_array[$#path_array];

	my @error_arr = ("cp: cannot stat $copy_from : No such file or directory");
	open my $in, '<:raw', $copy_from or die print encode_json( \@error_arr );

	@error_arr = ("cp: cannot stat $new_file : No such file or directory");
	open my $out, '>:raw', $new_file or die print encode_json( \@error_arr );

	my $len;
	my $data;

	while ( $len = sysread $in, $data, 4096 ) {
		syswrite $out, $data, $len;
	}

	if ( !defined $len ) {
		@error_arr = ("Cant read file");
		print encode_json( \@error_arr );
		exit;
	}
}

