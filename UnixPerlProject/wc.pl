#!/usr/bin/perl
use strict;
use warnings;

use Switch;
use JSON;

my $command = $ARGV[0];    #command
my $dirname = $ARGV[1];    #path for dir

my @error_arr = ("wc: $dirname: No such file or directory");
open my ($dh), $dirname or die print encode_json( \@error_arr );

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
my $longest_line = 0;

while(my $line = <$dh>) {
    #split line in a char array
    my @words = split(" ", $line);
    my @chars = split("", $line);
    
    $num_of_chars += length($line);
    $num_of_words += $#words;
    $num_of_lines ++;
    
    if (length($line) -1 > $longest_line) {
    	$longest_line = length($line) -1 ;
    }
}

switch ($command) {
	case "-l" {
		my @result = ("$num_of_lines $dirname");
		print encode_json( \@result );
	}
	case "-c" {
		
	}
	case "-m" {
		my @result = ("$num_of_chars $dirname");
		print encode_json( \@result );
	}
	case "-w" {
		my @result = ("$num_of_words $dirname");
		print encode_json( \@result );
	}
	case "-L" {
		my @result = ("$longest_line $dirname");
		print encode_json( \@result );
	}
	else {
		my @result = ("$num_of_lines $num_of_words $num_of_chars $dirname");
		print encode_json( \@result );
	}
}

close $dh;
