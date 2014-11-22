#!/usr/bin/perl

use Switch;
use JSON;

use strict;
use warnings;

require "/var/www/html/UnixLinuxProject/UnixPerlProject/cp.pl";
require "/var/www/html/UnixLinuxProject/UnixPerlProject/rm.pl";

my $dirname = $ARGV[0];    #path for dir we want copy
my $target  = $ARGV[1];    #path to copy dir

my @error_arr = ("cannot access $dirname: No such file or directory");
open my ($df), $dirname or die print encode_json( \@error_arr );

#check if its a file
if ( -f $df ) {
	copyFileText( $dirname, $target );
	unlink $dirname or warn "Could not unlink $dirname: $!";
	my @respond = ("File: $dirname moved");
	print encode_json(\@respond);
	exit;
} 

#first copy files and folders
copyFolderContent( $dirname, $target );


#after copy need to delete
opendir my $dh, $dirname or die print encode_json( \@error_arr );
my @all_files = readdir $dh;
my @un_dotted_files = grep { !/^\.\./ } @all_files;
closedir $dh;

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



