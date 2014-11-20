#!/usr/bin/perl
use Switch;
use JSON;

use strict;
use warnings;

my $dirname = $ARGV[0];    #path for dir we want search
my $target  = $ARGV[1];    #name of file to find
my $respond_str = '';
my @error_arr = ("cp: cannot stat $dirname : No such file or directory");

open my ($df), $dirname or die print encode_json( \@error_arr );

my $dh;

if ( -f $df ) {
	my @path_array = split( '/', $dirname );    #split the path inorder to get only the file name
	my $file_name = $path_array[$#path_array];
	
	if ( $file_name eq $target ) {
		$respond_str .= "$dirname\n";
	}
	my @arrOfStrFiles = split( '\n', $respond_str );
	print encode_json( \@arrOfStrFiles );
	exit;
}

opendir $dh, $dirname or die print encode_json( \@error_arr );
my @all_files = readdir $dh;
my @un_dotted_files = grep { !/^\.\./ } @all_files;
closedir $dh;


findFolderContent( $dirname, $target );

my @arrOfStrFiles = split( '\n', $respond_str );
print encode_json( \@arrOfStrFiles );

sub findFolderContent {
	my @params            = @_;
	my $current_directory = $params[0];    #folder/file we want to search
	my $target            = $params[1];    #file name to search for
	
	#if symbolic link we skip it
	if ( -l $current_directory ) {
		return;
	}
	
	my @path_array = split( '/', $current_directory );    #split the path inorder to get only the file name
	my $file_name = ($current_directory ne '/') ? $path_array[$#path_array] : '';
	
	if ( -d $current_directory ) {

		if ( $file_name eq $target ) {
			$respond_str .= "$current_directory\n";
		}
		my @error_arr = ("Cannot open $dirname : No such file or directory");
		
		opendir $dh, $current_directory or die print encode_json( \@error_arr );
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
				my $next_dir = ($current_directory ne '/') ? ($current_directory . '/' . $item) : ($current_directory . $item);
				findFolderContent( $next_dir, $target );
			}
		}

		return;
	}
	#stop condition if its not a dir
	else  {
		if ( $file_name eq $target ) {
			$respond_str .= "$current_directory\n";
		}
		return;
	}
}

