# Existing Repository File Map

Legacy scripts are retained in place and invoked through MVC adapters; they are not renamed or deleted in Phase 1.

## Root PHP endpoints
| Existing path | Clean route / treatment |
|---|---|
| index.php | / (front controller; original homepage copied to app/Legacy/Pages/home.php) |
| about.php | /about |
| connect.php | /connect |
| contact.php | /contact |
| faq.php | /faq |
| tos.php | /rules, /tos |
| vent.php | /vent |
| register.php | /register |
| status.php | /status |
| online.php | /online/{server}; legacy ?svr= remains supported |
| arena.php | /arena |
| ucp.php | /ucp |
| logout.php | /logout, /account/logout |
| donate.php | /donate |
| agree.php | /agree |
| accepted.php | /accepted |
| cancelled.php | /cancelled |
| index_template.php | Retained; dependency audit pending |
| accepted.html | Retained unchanged |

## Account
- account/index.php → /account
- account/bancheck.php → /account/bancheck
- account/revive.php → /account/revive
- account/teleport.php → /account/teleport
- account/userdetails.php → /account/userdetails
- account/includes.php remains in place

## Donations
- donate/index.php → /donate/terms and /donate/index
- donate/agree.php → /donate/donate
- donate/history.php → /donate/history
- donate/preview.php → /donate/preview
- donate/paypal.php → /donate/paypal
- donate/postback.php → /donate/postback
- donate/hidden/packages.php → /donate/packages
- donate/donate.php and donate/agree_old.php remain unchanged
- Root donate.php and donate/index.php are different existing pages.

## Voting
- vote/index.php → /vote
- vote/rewards.php → /vote/rewards
- vote/includes.php remains in place

## GM
- gm/index.php → /gm
- gm/banchecker.php → /gm/banchecker
- gm/donation.php → /gm/donation
- gm/instance.php → /gm/instance
- gm/instance_blizzonly.php → /gm/instance/blizz-only
- gm/passchange.php → /gm/passchange
- gm/promo.php → /gm/promo
- gm/vote.php → /gm/vote
- gm/old/ remains untouched

## Independent applications
forums/, wowhead/, tournament/ and php/ remain independent and untouched. Existing utility assets, error pages, downloads and helper endpoints remain in place.
