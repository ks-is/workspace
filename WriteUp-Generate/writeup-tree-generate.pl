#!/usr/bin/perl -w

use strict;
use warnings;

my $file = '_tree.ctf';
my $content = "";
my $readme_ctf = "";
my $readme_category = "";
my $readme;

open(my $INPUT, '<', $file)
	or die "[-] Could not open file '$file' $!\n";

while (my $row = <$INPUT>) {
	$content .= $row;
}
close $INPUT;
my @arr = split("\n", $content);

# Replace string.
sub replace {
	my $string = $_[0];
	$string =~ s/$_[1]/$_[2]/g;
	return $string;
}

# Clear space, break line.
sub clear {
	my $string = $_[0];
	$string =~ s/^\s+|\s+$//g;
	return $string;
}

# Get CTF title.
my $ctf_title = $arr[0]; shift @arr;
my $ctf_title_dir = replace($ctf_title, " ", "-");
$ctf_title_dir = clear($ctf_title_dir);
system("mkdir -p $ctf_title_dir");
print "[+] Create folder '$ctf_title_dir'\n";
$readme_ctf .= "## $ctf_title\n\n";
$readme_ctf .= "| Category | Numbers | Solved |\n";
$readme_ctf .= "| --- | --- | --- |\n";

# Generate category.
my %ctf_tree;
my @ctf_category_title;
my @readme_ctf_category_title;
my @ctf_challenge_title;
my @readme_ctf_challenge_title;
foreach my $item (@arr) {
	my @item_arr = split(":", $item);
	$ctf_tree{$item_arr[0]} = $item_arr[1];
}
foreach (sort keys %ctf_tree) {
	$readme_category = "";
	my @temp = split(",", clear($ctf_tree{$_}));
	my $temp_dir = replace($_, " ", "-");
	$temp_dir =~ s/[^A-Za-z0-9\-]//g;
	system("mkdir -p $ctf_title_dir/$temp_dir");
	system("touch $ctf_title_dir/$temp_dir/README.md") unless -f "$ctf_title_dir/$temp_dir/README.md";
	print "[+] Added README.md to folder '$ctf_title_dir/$temp_dir'\n";
	$readme_ctf .= "| [$_](./$temp_dir) | " . scalar(@temp) . " | 0 |\n";
	# README.md
	$readme_category .= "## $_\n\n";
	$readme_category .= "| Solved | Challenge | Point |\n";
	$readme_category .= "| --- | --- | --- |\n";
	foreach my $temp (@temp) {
		$temp = clear($temp);
		my ($title, $point) = $temp =~ m/(.+)\(([0-9]+)\)/ig;
		my $title_dir = replace($title, " ", "-");
		$title_dir =~ s/[^A-Za-z0-9\-]//g;
		$readme_category .= "| | [$title](./$title_dir) | $point |\n";
		system("mkdir -p $ctf_title_dir/$temp_dir/$title_dir");
		system("touch $ctf_title_dir/$temp_dir/$title_dir/_tree.README.md") unless -f "$ctf_title_dir/$temp_dir/$title_dir/_tree.README.md";
	}
	$readme = "$ctf_title_dir/$temp_dir/README.md";
	open(my $OUTPUT, '>', $readme) or die "[-] Could not open '$readme' $!\n";
	print $OUTPUT $readme_category;
	close $OUTPUT;
}

$readme = "$ctf_title_dir/README.md";
open(my $OUTPUT, '>', $readme) or die "[-] Could not open '$readme' $!\n";
print $OUTPUT $readme_ctf;
close $OUTPUT;
print "[+] Added README.md to '$ctf_title'\n";
print "[+] Done!\n";