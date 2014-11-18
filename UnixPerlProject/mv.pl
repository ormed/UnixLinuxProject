#!/usr/bin/perl
use Switch;
use JSON;

use strict;
use warnings;

#my $command = $ARGV[0];    #command
my $dirname = $ARGV[0];    #path for dir we want copy
my $target  = $ARGV[1];    #path to copy dir

#do '/var/www/html/UnixLinuxProject/UnixPerlProject/cp.pl -R $dirname $target';

#exec ('/var/www/html/UnixLinuxProject/UnixPerlProject/cp.pl -R $dirname $target')

system("/usr/bin/perl /var/www/html/UnixLinuxProject/UnixPerlProject/cp.pl -R $dirname $target ");

system("/usr/bin/perl /var/www/html/UnixLinuxProject/UnixPerlProject/rm.pl -r $dirname ");


