#!/usr/bin/perl
use Switch;
use JSON;

use strict;
use warnings;

my $command = $ARGV[0];    #command
my $dirname = $ARGV[1];    #path for dir want copy
my $target  = $ARGV[2];    #path to copy dir

my @error_arr = ("cp: cannot stat $dirname : No such file or directory");

open my ($df), $dirname or die print encode_json( \@error_arr );

my $dh;

if ( -f $df ) {
	copyFileText( $df, $target );
	exit;
}

opendir $dh, $dirname or die print encode_json( \@error_arr );
my @all_files = readdir $dh;
my @un_dotted_files = grep { !/^\.\./ } @all_files;
closedir $dh;

switch ($command) {
	case "-R" {
		if ( $#un_dotted_files > 0 ) {
			foreach my $item (@un_dotted_files) {
				if ( $item eq '.' ) {
					next;
				}
				elsif ( $item eq '..' ) {
					next;
				}
				else {
					copyFolderContent( $dirname . $item );
				}
			}
		}
		rmdir $dirname;
	}

	else {

	}
}

sub copyFolderContent {
	my @params    = @_;
	my $copy_from = $params[0];
	my $copy_to   = $params[1];
	my @temp_files;

	#stop condition if we reach our 'root' directory
	if ( $copy_from eq $dirname ) {
		return;
	}

	#stop condition if its a file
	if ( -f $copy_from ) {
		$copy_from =~
		  s/\/([\x00-\x2E\x30-\x7F]+)$/\//g;    # remove file name from path
		copyFileText( $copy_from, $copy_to );
		copyFolderContent($copy_from);
		return;
	}

	if ( -d $copy_from ) {
		opendir $dh, $copy_from or die print( \@error_arr );
		@temp_files = readdir $dh;
		close $dh;

		# safety - stopping condition if we reached an empty folder.
		my $size = $#temp_files;
		if ( $size == 0 ) {
			rmdir $copy_from;
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
				copyFolderContent( $copy_from . '/' . $item );
			}
		}
		rmdir $copy_from;
		return;
	}
}

sub copyFileText {
	my @params    = @_;
	my $copy_from = $params[0];
	my $copy_to   = $params[1];

	my @error_arr  = ("error");
	my @temp_files = readdir $dh;

	#open my ($dh), $dirname or die print encode_json( \@error_arr );
	foreach my $item (@temp_files) {
		if ( $item eq '.' ) {
			next;
		}
		elsif ( $item eq '..' ) {
			next;
		}
		else {
			open FILE, ">", "$copy_to.txt" or die $!;
			my $text_file = do { local $/; <$dh> };
			print FILE $text_file;
			close FILE;
		}
	}

}

