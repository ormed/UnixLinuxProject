#!/usr/bin/perl
use strict;
use warnings;

use Switch;
use JSON;

my $command = $ARGV[0];    #command
my $dirname = $ARGV[1];    #path for dir

my @error_arr = ("wc: $dirname: No such file or directory");
open my ($dh), '<:utf8', $dirname or die print encode_json( \@error_arr );

if ( -d $dh ) {
	my @error_arr = ("wc: $dirname: Is a directory");
	if ( $command ~~ ['-l', '-c', '-m', '-w', '-L'] ) {
		push (@error_arr, "0 $dirname");
	}
	else {
		push (@error_arr, "0 0 0 $dirname");
	}
	print encode_json( \@error_arr );
	exit;
}
#first collect all we need from file
my $num_of_chars = 0;
my $num_of_lines = 0;
my $num_of_words = 0;
my $num_of_bytes = 0;
my $longest_line = 0;

while(my $line = <$dh>) {
	#trim line before extract words
    my $temp_line = $line;
    $temp_line =~ s/^\s+//; #remove space in the beginning
	$temp_line =~ s/\s+$//; #remove space in the end
    $temp_line =~ s/^\t+//; #remove tabs in the beginning
	$temp_line =~ s/\t+$//; #remove tabs in the end
	
    #split line in a char array
    my @words = split(/\s+/, $temp_line);
    
    #calculate all params
    $num_of_chars += do { use utf8; length($line) };
    $num_of_words += $#words + 1;
    $num_of_bytes += do { use bytes;  length($line) };
    $num_of_lines ++;
    
    
    
    #$num_of_chars += $line =~ tr/[\x00-\x7F]//;
    #my $line_length = (length($line) -1) + ($num_of_tabs * TAB_SIZE)- $num_of_tabs;
    #my $line_length = do { use bytes;  length($line) };
    #if ($line_length > $longest_line) {
    #	$longest_line = $line_length ;
    #}
}
my @result;
switch ($command) {
	case "-l" {
		@result = ("$num_of_lines $dirname");
	}
	case "-c" {
		@result = ("$num_of_bytes $dirname");
	}
	case "-m" {
		@result = ("$num_of_chars $dirname");
	}
	case "-w" {
		@result = ("$num_of_words $dirname");
	}
	case "-L" {
		@result = ("$longest_line $dirname");
	}
	else {
		@result = ("$num_of_lines $num_of_words $num_of_bytes $dirname");
	}
}

print encode_json( \@result );
close $dh;
