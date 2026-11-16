<?php
/*======================================================================*\
|| #################################################################### ||
|| # vBulletin 4.0.1 - Licence Number VBF4D25FD1
|| # ---------------------------------------------------------------- # ||
|| # Copyright ©2000-2010 vBulletin Solutions Inc. All Rights Reserved. ||
|| # This file may not be redistributed in whole or significant part. # ||
|| # ---------------- VBULLETIN IS NOT FREE SOFTWARE ---------------- # ||
|| # http://www.vbulletin.com | http://www.vbulletin.com/license.html # ||
|| #################################################################### ||
\*======================================================================*/

if (!isset($GLOBALS['vbulletin']->db))
{
	exit;
}

// display the credits table for use in admin/mod control panels

print_form_header('index', 'home');
print_table_header($vbphrase['vbulletin_developers_and_contributors']);
print_column_style_code(array('white-space: nowrap', ''));
print_label_row('<b>' . $vbphrase['software_developed_by'] . '</b>', '
	<a href="http://www.vbulletin.com/" target="vbulletin">vBulletin Solutions, Inc.</a>,
	<a href="http://www.internetbrands.com/" target="vbulletin">Internet Brands, Inc.</a>
', '', 'top', NULL, false);
print_label_row('<b>' . $vbphrase['business_development'] . '</b>', '
	<a href="http://www.vbulletin.com/forum/member.ph' . 'p?u=2" target="vbulletin">James Limm</a>,
	<a href="http://www.vbulletin.com/forum/member.ph' . 'p?u=22709" target="vbulletin">Ashley Busby</a>,
	<a href="http://www.vbulletin.com/forum/member.ph' . 'p?u=232886" target="vbulletin">Ray Morgan</a>,
	<a href="http://www.vbulletin.com/forum/member.ph' . 'p?u=272640" target="vbulletin">Joe Rosenblum</a>,
	<a href="http://www.vbulletin.com/forum/member.ph' . 'p?u=234854" target="vbulletin">Jen Rundell</a>
', '', 'top', NULL, false);
print_label_row('<b>' . $vbphrase['engineering'] . '</b>', '
	<a href="http://www.vbulletin.com/forum/member.ph' . 'p?u=214190" target="vbulletin">Kevin Sours</a>,
	<a href="http://www.vbulletin.com/forum/member.ph' . 'p?u=224" target="vbulletin">Freddie Bingham</a>,
	<a href="http://www.vbulletin.com/forum/member.ph' . 'p?u=218637" target="vbulletin">Darren Gordon</a>,
	<a href="http://www.vbulletin.com/forum/member.ph' . 'p?u=250802" target="vbulletin">Edwin Brown</a>,
	<a href="http://www.vbulletin.com/forum/member.ph' . 'p?u=260819" target="vbulletin">Andrew Elkins</a>,
	<a href="http://www.vbulletin.com/forum/member.ph' . 'p?u=266078" target="vbulletin">Michael Henretty</a>,
	<a href="http://www.vbulletin.com/forum/member.ph' . 'p?u=23871" target="vbulletin">Xiaoyu Huang</a>,
	<a href="http://www.vbulletin.com/forum/member.ph' . 'p?u=44899" target="vbulletin">Mert Gokceimam</a>,
	<a href="http://www.vbulletin.com/forum/member.ph' . 'p?u=42534" target="vbulletin">Andy Huang</a>,
	<a href="http://www.vbulletin.com/forum/member.ph' . 'p?u=193838" target="vbulletin">Chris Holland</a>,
	<a href="http://www.vbulletin.com/forum/member.ph' . 'p?u=264173" target="vbulletin">Joan Gauna</a>,
	<a href="http://www.vbulletin.com/forum/member.ph' . 'p?u=216095" target="vbulletin">David Grove</a>,
	<a href="http://www.vbulletin.com/forum/member.ph' . 'p?u=215955" target="vbulletin">David Bonilla</a>,
	<a href="http://www.vbulletin.com/forum/member.ph' . 'p?u=260829" target="vbulletin">Pritesh Shah</a>,
	<a href="http://www.vbulletin.com/forum/member.ph' . 'p?u=262025" target="vbulletin">Prince Shah</a>,
	<a href="http://www.vbulletin.com/forum/member.ph' . 'p?u=262689" target="vbulletin">Tully Rankin</a>,
	<a href="http://www.vbulletin.com/forum/member.ph' . 'p?u=1034" target="vbulletin">Kier Darby</a>,
	<a href="http://www.vbulletin.com/forum/member.ph' . 'p?u=1814" target="vbulletin">Scott MacVicar</a>,
	<a href="http://www.vbulletin.com/forum/member.ph' . 'p?u=37" target="vbulletin">Mike Sullivan</a>,
	<a href="http://www.vbulletin.com/forum/member.ph' . 'p?u=24628" target="vbulletin">Jerry Hutchings</a>
', '', 'top', NULL, false);
print_label_row('<b>' . $vbphrase['product'] . '</b>', '
	<a href="http://www.vbulletin.com/forum/member.ph' . 'p?u=259494" target="vbulletin">Don Kuramura</a>
', '', 'top', NULL, false);
print_label_row('<b>' . $vbphrase['graphics_development'] . '</b>', '
	<a href="http://www.vbulletin.com/forum/member.ph' . 'p?u=268290" target="vbulletin">Sophie Xie</a>,
	<a href="http://www.vbulletin.com/forum/member.ph' . 'p?u=1034" target="vbulletin">Kier Darby</a>
', '', 'top', NULL, false);
print_label_row('<b>' . $vbphrase['qa'] . '</b>', '
	<a href="http://www.vbulletin.com/forum/member.ph' . 'p?u=255358" target="vbulletin">Allen Lin</a>,
	<a href="http://www.vbulletin.com/forum/member.ph' . 'p?u=255359" target="vbulletin">Meghan Sensenbach</a>,
	<a href="http://www.vbulletin.com/forum/member.ph' . 'p?u=271480" target="vbulletin">Ryan Burch</a>
', '', 'top', NULL, false);
print_label_row('<b>' . $vbphrase['support'] . '</b>', '
	<a href="http://www.vbulletin.com/forum/member.ph' . 'p?u=656" target="vbulletin">Steve Machol</a>,
	<a href="http://www.vbulletin.com/forum/member.ph' . 'p?u=868" target="vbulletin">Wayne Luke</a>,
	<a href="http://www.vbulletin.com/forum/member.ph' . 'p?u=48331" target="vbulletin">Colin Frei</a>,
	<a href="http://www.vbulletin.com/forum/member.ph' . 'p?u=30801" target="vbulletin">Carrie Anderson</a>,
	<a href="http://www.vbulletin.com/forum/member.ph' . 'p?u=245" target="vbulletin">George Liu</a>,
	<a href="http://www.vbulletin.com/forum/member.ph' . 'p?u=2026" target="vbulletin">Jake Bunce</a>,
	<a href="http://www.vbulletin.com/forum/member.ph' . 'p?u=19405" target="vbulletin">Zachery Woods</a>,
	<a href="http://www.vbulletin.com/forum/member.ph' . 'p?u=60067" target="vbulletin">Marco van Herwaarden</a>,
	<a href="http://www.vbulletin.com/forum/member.ph' . 'p?u=168289" target="vbulletin">Marlena Machol</a>
', '', 'top', NULL, false);
print_label_row('<b>' . $vbphrase['special_thanks_to'] . '</b>', '
	Adrian Sacchi, Andreas Kirbach, Aston Jay, Bob Pankala, Brian Swearingen, Brian Gunter, Chen Avinadav, Chevy Revata, Christopher Riley, 
	Daniel Clements, David Webb, David Yancy, Dominic Schlatter, Don T. Romrell, Doron Rosenberg, Elmer Hernandez, Fernando Munoz,
	Giovanni Martinez, Hanafi Jamil, Hanson Wong, Hartmut Voss, Jacquii Cooke, Jan Allan Zischke, Jeremy Dentel, 
	Joe Velez, Joel Young, John Jakubowski, John Simpson, Jonathan Javier Coletta, Joseph DeTomaso, Kevin Schumacher, Kevin Wilkinson, 
	Kira Lerner, Kolby Bothe, Lisa Swift, Lynne D Sands, Mark James, Martin Meredith, Matthew Gordon, Michael Biddle, Michael Kellogg, Michael \'Mystics\' K&ouml;nig,
	Michael Pierce, Milad Kawas Cale, Nathan Wingate, Nawar Al-Mubaraki, Ole Vik, Overgrow, Paul Marsden, 
	Peggy Lynn Gurney, Robert Beavan White, Ryan Royal, Sal Colascione III, Scott Molinari, Scott William, 
	Shawn Vowell, Stephan \'pogo\' Pogodalla, Sven Keller, Tom Murphy, Tony Phoenix, Torstein H&oslash;nsi, Trevor Hannant, Vinayak Gupta
', '', 'top', NULL, false);
print_label_row('<b>' . $vbphrase['copyright_enforcement_by'] . '</b>', '
	<a href="http://www.piratereports.com/" target="vbulletin">Pirate Reports</a>
', '', 'top', NULL, false);
print_table_footer();

/*======================================================================*\
|| ####################################################################
|| # Downloaded: 21:31, Wed Feb 3rd 2010
|| # CVS: $RCSfile$ - $Revision: 34363 $
|| ####################################################################
\*======================================================================*/
?>
