#!/usr/bin/perl
use strict;
use warnings;

use constant false => 0;
use constant true  => 1;

my $user_name = $ARGV[0];   #user name to varify password
my $password = $ARGV[1];    #password to verify

#find hash from shadow file
my $dirname  = '/etc/shadow';
my @error_arr = ("$dirname: No such file or directory");
open my ($dh), '<:utf8', $dirname or die print encode_json( \@error_arr );

my $text_file = do { local $/; <$dh> };

my @full_hash = $text_file =~ qr/$user_name:(.+?):/;

if (@full_hash) {
	my @salt = $full_hash[0] =~ qr/^\$6\$([^\$].*)\$/;

	my $crypt_pass = crypt($password,"\$6\$$salt[0]\$");

	if ($full_hash[0] eq $crypt_pass) {
		print true;
		exit;
	}
}

print false;

