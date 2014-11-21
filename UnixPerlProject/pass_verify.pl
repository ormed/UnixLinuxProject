#!/usr/bin/perl
use JSON;

use strict;
use warnings;

my $password = $ARGV[0];    #password to verify

#find hash from shadow file
my @error_arr = ("$dirname: No such file or directory");
open my ($dh), '<:utf8', $dirname or die print encode_json( \@error_arr );

my $text_file = do { local $/; <$dh> };


my $crypt_pass = crypt($password,"\$6\$fWNQdUdz\$");
