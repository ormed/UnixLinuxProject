#!/usr/bin/perl
use Switch;
use JSON;

use strict;
use warnings;

my $command = $ARGV[0];    #command
my $dirname = $ARGV[1];    #path for dir

my @error_arr = ("cannot access $dirname: No such file or directory");

open my ($df), $dirname or die print encode_json( \@error_arr );

my $dh;

if ( -f $df ) {
	unlink $dirname or warn "Could not unlink $dirname: $!";
	my @respond = ("File: $dirname deleted");
	print encode_json(\@respond);
	exit;
} 

opendir $dh, $dirname or die print encode_json(\@error_arr);
my @all_files = readdir $dh;
my @un_dotted_files = grep { !/^\.\./ } @all_files;
closedir $dh;


switch ($command) {
	case "-r" {
		if ($#un_dotted_files > 0) {
			foreach my $item (@un_dotted_files) {
				if ( $item eq '.') {
					next;
				} elsif ( $item eq '..') {
					next;
				} else {
					removeFolderContent($dirname . $item);	
				}
			}	
		}
		rmdir $dirname;
		my @respond = ("directory $dirname deleted");
		print encode_json(\@respond); 
	}

	else {

		# rm
		foreach my $file (@all_files) {
			unlink $file or warn "Could not unlink $file: $!";
		}
	}
}


sub removeFolderContent {
	my @params = @_;
	my $current_directory = $params[0];
	my @temp_files;
	
	#stop condition if we reach our 'root' directory
	if ( $current_directory eq $dirname ) {
		return;
	}
	
	#stop condition if its a file
	if ( -f $current_directory ) {
		unlink $current_directory;
		$current_directory =~ s/\/([\x00-\x2E\x30-\x7F]+)$/\//g;	# remove file name from path
		removeFolderContent($current_directory);
		return;
	}
	
	if ( -d $current_directory ) {
		opendir $dh, $current_directory or die print (\@error_arr);
		@temp_files = readdir $dh;
		close $dh;
		
		# safety - stopping condition if we reached an empty folder.
		my $size = $#temp_files;
		if ($size == 0 ) {
			rmdir $current_directory;
			return;
		}
		
		foreach my $item (@temp_files) {
			if ( $item eq '.') {
				next;
			} elsif ( $item eq '..') {
				next;
			} else {
				removeFolderContent($current_directory . '/' . $item);	
			}
		}
		
		rmdir $current_directory;
		return;
	}
	
}



