<?php
include_once("includes.php");

$structure = new Structure;

$msg = "<script type='text/javascript'> 
    function show_alert() { 
    alert('You must agree to our ToS!'); 
    }
    </script>";

$structure->Header($msg);

// place the page name in the brackets ex: Top_Menu('index'); this will highlight the button on the top menu, leave blank for nothing to be highlighted.
$structure->Top_Menu('donate');

//place the page title in the quotes, include html syntax.
$structure->Title_Bar("<h2><font size='4'>Terms of Service</font></h2>");

//------ Content Start ------//
?>
            <div class="body_resize">
                <div class="body">
                    <div class="left">
                        <center>
                            <h1><font size='4'>By choosing I Agree below, you agree to be bound by our terms and conditions, outlined below. If you do not agree to these terms, please click I Disagree instead.</font></h1>
                            <br />
                            <br />
                            <br />
                            <table width="600" border="0"> 
                            <tr> 
                            <td> 
                                <center> 
                                    <textarea rows="20" cols="60"> 
1. Definition of Donation
You agree that you are donating of your own free will and independent of any expectation of any item in return. Your donation is not a payment, and not an exchange for a good or service. It is currently the policy of World of Immortality to reward those who donate with certain in-game items. However, these items are not being purchased or bought in any way; they are merely a gift given by the staff of World of Immortality. World of Immortality does not sell any good or service, and relies on donations to offset administration and server fees; therefore any item you may receive from the staff of World of Immortality will be considered a gift and not a tangible good or an exchange of any kind.
 
2. Donation Rewards
You understand that if the item you receive as a donation is lost, broken, unusable, or unwanted, you will not be entitled to a refund.  It is your responsibility to retain a copy of your donation receipt.  If such a copy is kept, World of Immortality may, at its discretion, replace missing or otherwise unusable donation rewards.  Your donation is not an exchange for any reward, so all donations are completely non-refundable.  World of Immortality reserves the right to pursue any legal or collection action necessary to recover damages in the event of a forced charge-back.
 
3. Right to Change Prices
World of Immortality reserves the right to change, with or without notice, the gifts given to those who donate to the server. In the event that you have paid for an item and such a change occurs before you are given a reward, World of Immortality may, at its discretion, give you the item corresponding to your original donation amount.
 
4. Indemnification
You agree to indemnify and harmless the staff, owners, hosts, advertisers, officers, directors, employees, partners, and all other parties related to World of Immortality.  By agreeing to these terms, you agree not to present any lawsuit or other legal challenge against World of Immortality for any reason, whether related to your donation or not.
 
5. Disclaimer of warranties
You understand and agree that your use of this website and any services or content provided is made available and provided to you at your own risk. It is provided to you as-is and we expressly disclaim all warranties of any kind, expressed or implied, including but not limited to the warranties of merchantability, fitness for a particular purpose, and non-infringement. We make no warranty, implied or express, that any part of the service will be uninterrupted, error-free, virus-free, timely, secure, accurate, reliable, of any quality, nor that any content is safe in any manner for download. You understand and agree that neither us nor any participant in the service provides professional advice of any kind and thus use of such advice or any other information is solely at your own risk and without our liability of any kind. Some jurisdictions may not allow disclaimers of implied warranties and the above disclaimer may not apply to you only as it relates to implied warranties.
 
6. Limitation of liability
You expressly understand and agree that we shall not be liable for any direct, indirect, special, incidental, consequential or exemplary damages, including but not limited to, damages for loss of profits, goodwill, use, data or other intangible loss (even if we have been advised of the possibility of such damages), resulting from or arising out of (I) The use of or the inability to use the service, (II) The cost to obtain substitute goods and/or services resulting from any transaction entered into on trough the service, (III) Unauthorized access to or alternation of your data transmissions, (IV) Statements or conduct of any third party on the service, or (V) any other matter relating to the service. Note that by accepting the terms in the document, you are also waiving your right, to take any action, legal or otherwise, against anyone or anything related to the staff, management, administrators, members, owners, or hosts of World of Immortality. You furthermore acknowledge that if any part of this document is found to be invalid or unenforceable in any way, any parts not found to be invalid or unenforceable will be considered fully valid and binding. 
                                    </textarea> 
                                    <br /> 
                                    <br /> 
                                    <a href="agree.php"><font size="5" face="arial" color="#77aaee"><u>I Agree</u></font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../index.php"><font size="5" face="arial" color="red"><u>I Disagree</u></font></a> 
                                    <br /> 
                                    <br /> 
                                    <br /> 
                                </center> 
                            </td> 
                            </tr> 
                        </table>
                        </center>
                    </div>
                    <div class="right">
                        <?php $structure->UserInfo('donate_block'); ?>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="clr"></div>
            </div>
<?php
$structure->Footer();
?>