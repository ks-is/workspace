#!/usr/bin/perl -w

use strict;
use warnings;

my $file = '_tree.README.md';
my $content;
my $readme;

# Clear space, break line.
sub clear {
	my $string = $_[0];
	$string =~ s/^\s+|\s+$//g;
	return $string;
}

# Get _tree.README.md
open(my $INPUT, '<', $file)
	or die "[-] Could not open file '$file' $!\n";

while (my $row = <$INPUT>) {
	$content .= $row;
}
close $INPUT;

# Transform.
$content =~ s/\n+/\n/g;
my @arr = split("\n", $content);

my $title = clear($arr[0]); shift(@arr);
my $info = clear($arr[0]); shift(@arr);
my ($category, $point) = $info =~ m/(.+)\|([0-9]+)/ig;

@arr = map { "> $_ <br>" } @arr;

$readme .= "## $title\n\n";
$readme .= "| Category | Point |\n";
$readme .= "| --- | --- |\n";
$readme .= "| ".clear($category)." | ".clear($point)." |\n\n";
for my $item (@arr) {
	$readme .= clear($item)."\n";
}
$readme .= "\n## WriteUp\n\n";
$readme .= "(TODO)\n";

# Save to README.md
system("rm _tree.README.md");
print "[+] Remove _tree.README.md\n";
my $readme_dir = "README.md";
open(my $OUTPUT, '>', $readme_dir) or die "[-] Could not open '$readme_dir' $!\n";
print $OUTPUT $readme;
close $OUTPUT;
print "[+] Created README.md\n";
print "[+] Done!\n";