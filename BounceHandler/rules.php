<?php if ( ! class_exists('BounceHandler', false)) exit('No direct script access allowed');

return array(
    
    BounceHandler::DIAGNOSTIC_CODE_RULES => array(
        /**
         * Triggered by:
         * 
         * Diagnostic-Code: X-Postfix; me.domain.com platform: said: 552 5.2.2 Over
         *   quota (in reply to RCPT TO command)
         * 
         * Diagnostic-Code: SMTP; 552 Requested mailbox exceeds quota.
         */
         array(
             'bounceType'    => BounceHandler::BOUNCE_SOFT,
             'regex'         => "/(over|exceed).*quota/is"
         ),
         
        /**
         * Triggered by:
         * 
         * Diagnostic-Code: smtp;552 5.2.2 This message is larger than the current system limit or the recipient's mailbox is full. Create a shorter message body or remove attachments and try sending it again.
         * 
         * Diagnostic-Code: X-Postfix; host mta5.us4.domain.com.int[111.111.111.111] said:
         *   552 recipient storage full, try again later (in reply to RCPT TO command)
         * 
         * Diagnostic-Code: X-HERMES; host 127.0.0.1[127.0.0.1] said: 551 bounce as<the
         *   destination mailbox <xxxxx@yourdomain.com> is full> queue as
         *   100.1.ZmxEL.720k.1140313037.xxxxx@yourdomain.com (in reply to end of
         *   DATA command)
         */
         array(
             'bounceType'    => BounceHandler::BOUNCE_SOFT,
             'regex'         => "/(?:alias|account|recipient|address|email|mailbox|user).*full/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 452 Insufficient system storage
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_SOFT,
             'regex'         => "/Insufficient system storage/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: X-Postfix; cannot append message to destination file^M
          * /var/mail/dale.me89g: error writing message: File too large^M
          * 
          * Diagnostic-Code: X-Postfix; cannot access mailbox /var/spool/mail/b8843022 for^M
          * user xxxxx. error writing message: File too large
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_SOFT,
             'regex'         => "/File too large/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: smtp;552 5.2.2 This message is larger than the current system limit or the recipient's mailbox is full. Create a shorter message body or remove attachments and try sending it again.
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_SOFT,
             'regex'         => "/larger than.*limit/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: X-Notes; User xxxxx (xxxxx@yourdomain.com) not listed in public Name & Address Book
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/(?:alias|account|recipient|address|email|mailbox|user)(.*)not(.*)list/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: smtp; 450 user path no exist
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/user path no exist/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 550 Relaying denied.
          * 
          * Diagnostic-Code: SMTP; 554 <xxxxx@yourdomain.com>: Relay access denied
          * 
          * Diagnostic-Code: SMTP; 550 relaying to <xxxxx@yourdomain.com> prohibited by administrator
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/Relay.*(?:denied|prohibited)/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 554 qq Sorry, no valid recipients (#5.1.3)
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/no.*valid.*(?:alias|account|recipient|address|email|mailbox|user)/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 550 «Dªk¦a§} - invalid address (#5.5.0)
          * 
          * Diagnostic-Code: SMTP; 550 Invalid recipient: <xxxxx@yourdomain.com>
          * 
          * Diagnostic-Code: SMTP; 550 <xxxxx@yourdomain.com>: Invalid User
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/Invalid.*(?:alias|account|recipient|address|email|mailbox|user)/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 554 delivery error: dd Sorry your message to xxxxx@yourdomain.com cannot be delivered. This account has been disabled or discontinued [#102]. - mta173.mail.tpe.domain.com
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/(?:alias|account|recipient|address|email|mailbox|user).*(?:disabled|discontinued)/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 554 delivery error: dd This user doesn't have a domain.com account (www.xxxxx@yourdomain.com) [0] - mta134.mail.tpe.domain.com
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/user doesn't have.*account/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 550 5.1.1 unknown or illegal alias: xxxxx@yourdomain.com
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/(?:unknown|illegal).*(?:alias|account|recipient|address|email|mailbox|user)/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 450 mailbox unavailable.
          * 
          * Diagnostic-Code: SMTP; 550 5.7.1 Requested action not taken: mailbox not available
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/(?:alias|account|recipient|address|email|mailbox|user).*(?:un|not\s+)available/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 553 sorry, no mailbox here by that name (#5.7.1)
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/no (?:alias|account|recipient|address|email|mailbox|user)/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 550 User (xxxxx@yourdomain.com) unknown.
          * 
          * Diagnostic-Code: SMTP; 553 5.3.0 <xxxxx@yourdomain.com>... Addressee unknown, relay=[111.111.111.000]
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/(?:alias|account|recipient|address|email|mailbox|user).*unknown/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 550 user disabled
          * 
          * Diagnostic-Code: SMTP; 452 4.2.1 mailbox temporarily disabled: xxxxx@yourdomain.com
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/(?:alias|account|recipient|address|email|mailbox|user).*disabled/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 550 <xxxxx@yourdomain.com>: Recipient address rejected: No such user (xxxxx@yourdomain.com)
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/No such (?:alias|account|recipient|address|email|mailbox|user)/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 550 MAILBOX NOT FOUND
          * 
          * Diagnostic-Code: SMTP; 550 Mailbox ( xxxxx@yourdomain.com ) not found or inactivated
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/(?:alias|account|recipient|address|email|mailbox|user).*NOT FOUND/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: X-Postfix; host m2w-in1.domain.com[111.111.111.000] said: 551
          * <xxxxx@yourdomain.com> is a deactivated mailbox (in reply to RCPT TO
          * command)
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/deactivated (?:alias|account|recipient|address|email|mailbox|user)/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 550 <xxxxx@yourdomain.com> recipient rejected
          * ...
          * <<< 550 <xxxxx@yourdomain.com> recipient rejected
          * 550 5.1.1 xxxxx@yourdomain.com... User unknown
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/(?:alias|account|recipient|address|email|mailbox|user).*reject/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: smtp; 5.x.0 - Message bounced by administrator  (delivery attempts: 0)
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/bounce.*administrator/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 550 <maxqin> is now disabled with MTA service.
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/<.*>.*disabled/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 551 not our customer
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/not our customer/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: smtp; 5.1.0 - Unknown address error 540-'Error: Wrong recipients' (delivery attempts: 0)
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/Wrong (?:alias|account|recipient|address|email|mailbox|user)/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: smtp; 5.1.0 - Unknown address error 540-'Error: Wrong recipients' (delivery attempts: 0)
          * 
          * Diagnostic-Code: SMTP; 501 #5.1.1 bad address xxxxx@yourdomain.com
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/(?:unknown|bad).*(?:alias|account|recipient|address|email|mailbox|user)/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 550 Command RCPT User <xxxxx@yourdomain.com> not OK
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/(?:alias|account|recipient|address|email|mailbox|user).*not OK/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 550 5.7.1 Access-Denied-XM.SSR-001
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/Access.*Denied/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 550 5.1.1 <xxxxx@yourdomain.com>... email address lookup in domain map failed^M
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/(?:alias|account|recipient|address|email|mailbox|user).*lookup.*fail/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 550 User not a member of domain: <xxxxx@yourdomain.com>^M
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/(?:recipient|address|email|mailbox|user).*not.*member of domain/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 550-"The recipient cannot be verified.  Please check all recipients of this^M
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/(?:alias|account|recipient|address|email|mailbox|user).*cannot be verified/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 550 Unable to relay for xxxxx@yourdomain.com
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/Unable to relay/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 550 xxxxx@yourdomain.com:user not exist
          * 
          * Diagnostic-Code: SMTP; 550 sorry, that recipient doesn't exist (#5.7.1)
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/(?:alias|account|recipient|address|email|mailbox|user).*(?:n't|not) exist/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 550-I'm sorry but xxxxx@yourdomain.com does not have an account here. I will not
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/not have an account/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 550 This account is not allowed...xxxxx@yourdomain.com
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/(?:alias|account|recipient|address|email|mailbox|user).*is not allowed/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 550 <xxxxx@yourdomain.com>: inactive user
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/inactive.*(?:alias|account|recipient|address|email|mailbox|user)/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 550 xxxxx@yourdomain.com Account Inactive
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/(?:alias|account|recipient|address|email|mailbox|user).*Inactive/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 550 <xxxxx@yourdomain.com>: Recipient address rejected: Account closed due to inactivity. No forwarding information is available.
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/(?:alias|account|recipient|address|email|mailbox|user) closed due to inactivity/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 550 <xxxxx@yourdomain.com>... User account not activated
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/(?:alias|account|recipient|address|email|mailbox|user) not activated/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 550 User suspended
          * 
          * Diagnostic-Code: SMTP; 550 account expired
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/(?:alias|account|recipient|address|email|mailbox|user).*(?:suspend|expire)/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 553 5.3.0 <xxxxx@yourdomain.com>... Recipient address no longer exists
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/(?:alias|account|recipient|address|email|mailbox|user).*no longer exist/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 553 VS10-RT Possible forgery or deactivated due to abuse (#5.1.1) 111.111.111.211^M
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/(?:forgery|abuse)/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 553 mailbox xxxxx@yourdomain.com is restricted
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/(?:alias|account|recipient|address|email|mailbox|user).*restrict/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 550 <xxxxx@yourdomain.com>: User status is locked.
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/(?:alias|account|recipient|address|email|mailbox|user).*locked/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 553 User refused to receive this mail.
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/(?:alias|account|recipient|address|email|mailbox|user) refused/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 501 xxxxx@yourdomain.com Sender email is not in my domain
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/sender.*not/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 554 Message refused
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/Message (refused|reject(ed)?)/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 550 5.0.0 <xxxxx@yourdomain.com>... No permit
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/No permit/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 553 sorry, that domain isn't in my list of allowed rcpthosts (#5.5.3 - chkuser)
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/domain isn't in.*allowed rcpthost/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 553 AUTH FAILED - xxxxx@yourdomain.com^M
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/AUTH FAILED/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 550 relay not permitted^M
          * 
          * Diagnostic-Code: SMTP; 530 5.7.1 Relaying not allowed: xxxxx@yourdomain.com
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/relay.*not.*(?:permit|allow)/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 550 not local host domain.com, not a gateway
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/not local host/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 500 Unauthorized relay msg rejected
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/Unauthorized relay/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 554 Transaction failed
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/Transaction.*fail/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: smtp;554 5.5.2 Invalid data in message
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/Invalid data/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 550 Local user only or Authentication mechanism
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/Local user only/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 550-ds176.domain.com [111.111.111.211] is currently not permitted to
          * relay through this server. Perhaps you have not logged into the pop/imap
          * server in the last 30 minutes or do not have SMTP Authentication turned on
          * in your email client.
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/not.*permit.*to/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 550 Content reject. FAAAANsG60M9BmDT.1
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/Content reject/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 552 MessageWall: MIME/REJECT: Invalid structure
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/MIME\/REJECT/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: smtp; 554 5.6.0 Message with invalid header rejected, id=13462-01 - MIME error: error: UnexpectedBound: part didn't end with expected boundary [in multipart message]; EOSToken: EOF; EOSType: EOF
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/MIME error/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 553 Mail data refused by AISP, rule [169648].
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/Mail data refused.*AISP/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 550 Host unknown
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/Host unknown/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 553 Specified domain is not allowed.
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/Specified domain.*not.*allow/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: X-Postfix; delivery temporarily suspended: connect to
          * 111.111.11.112[111.111.11.112]: No route to host
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/No route to host/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 550 unrouteable address
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/unrouteable address/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 451 System(u) busy, try again later.
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_SOFT,
             'regex'         => "/System.*busy/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 451 mta172.mail.tpe.domain.com Resources temporarily unavailable. Please try again later.  [#4.16.4:70].
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_SOFT,
             'regex'         => "/Resources temporarily unavailable/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 554 sender is rejected: 0,mx20,wKjR5bDrnoM2yNtEZVAkBg==.32467S2
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/sender is rejected/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 554 <unknown[111.111.111.000]>: Client host rejected: Access denied
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/Client host rejected/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 554 Connection refused(mx). MAIL FROM [xxxxx@yourdomain.com] mismatches client IP [111.111.111.000].
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/MAIL FROM(.*)mismatches client IP/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 554 Please visit http:// antispam.domain.com/denyip.php?IP=111.111.111.000 (#5.7.1)
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/denyip/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 554 Service unavailable; Client host [111.111.111.211] blocked using dynablock.domain.com; Your message could not be delivered due to complaints we received regarding the IP address you're using or your ISP. See http:// blackholes.domain.com/ Error: WS-02^M
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/client host.*blocked/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 550 Requested action not taken: mail IsCNAPF76kMDARUY.56621S2 is rejected,mx3,BM
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/mail.*reject/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 552 sorry, the spam message is detected (#5.6.0)
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/spam.*detect/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 554 5.7.1 Rejected as Spam see: http:// rejected.domain.com/help/spam/rejected.html
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/reject.*spam/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 553 5.7.1 <xxxxx@yourdomain.com>... SpamTrap=reject mode, dsn=5.7.1, Message blocked by BOX Solutions (www.domain.com) SpamTrap Technology, please contact the domain.com site manager for help: (ctlusr8012).^M
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/SpamTrap/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 550 Verify mailfrom failed,blocked
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/Verify mailfrom failed/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 550 Error: MAIL FROM is mismatched with message header from address!
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/MAIL.*FROM.*mismatch/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 554 5.7.1 Message scored too high on spam scale.  For help, please quote incident ID 22492290.
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/spam scale/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 550 sorry, it seems as a junk mail
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/junk mail/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 553-Message filtered. Please see the FAQs section on spam
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/message filtered/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 554 5.7.1 The message from (<xxxxx@yourdomain.com>) with the subject of ( *(ca2639) 7|-{%2E* : {2"(%EJ;y} (SBI$#$@<K*:7s1!=l~) matches a profile the Internet community may consider spam. Please revise your message before resending.
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/subject.*consider.*spam/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 451 Temporary local problem - please try later
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_SOFT,
             'regex'         => "/Temporary local problem/is"
         ),
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 553 5.3.5 system config error
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_SOFT,
             'regex'         => "/system config error/is"
         ),    
         
         /**
          * Triggered by:
          * 
          * Diagnostic-Code: SMTP; 554- (RTR:BL)
          * http://postmaster.info.aol.com/errors/554rtrbl.html 554  Connecting IP:
          * 111.111.111.111
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/(\s+)?\(RTR:BL\)/is"
         ),
    ),
    
    BounceHandler::DSN_MESSAGE_RULES => array(
        /**
          * Triggered by:
          * 
          * Diagnostic-Code: X-Postfix; delivery temporarily suspended: conversation with^M
          * 111.111.111.11[111.111.111.11] timed out while sending end of data -- message may be^M
          * sent more than once
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_SOFT,
             'regex'         => "/delivery.*suspend/is"
         ),
         
         /**
          * Triggered by:
          * 
          *  ----- The following addresses had permanent fatal errors -----
          * <xxxxx@yourdomain.com>
          * ----- Transcript of session follows -----
          * ... while talking to mta1.domain.com.:
          * >>> DATA
          * <<< 503 All recipients are invalid
          * 554 5.0.0 Service unavailable
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/(?:alias|account|recipient|address|email|mailbox|user)(.*)invalid/i"
         ),
         
         /**
          * Triggered by:
          * 
          * ----- Transcript of session follows -----
          * xxxxx@yourdomain.com... Deferred: No such file or directory
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/Deferred.*No such.*(?:file|directory)/i"
         ),
         
         /**
          * Triggered by:
          * 
          * Failed to deliver to '<xxxxx@yourdomain.com>'^M
          * LOCAL module(account xxxx) reports:^M
          * mail receiving disabled^M
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/mail receiving disabled/i"
         ),
         
         /**
          * Triggered by:
          * 
          * - These recipients of your message have been processed by the mail server:^M
          * xxxxx@yourdomain.com; Failed; 5.1.1 (bad destination mailbox address)
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/bad.*(?:alias|account|recipient|address|email|mailbox|user)/i"
         ),
         
         /**
          * Triggered by:
          * 
          * This Message was undeliverable due to the following reason:
          * The user(s) account is temporarily over quota.
          * <xxxxx@yourdomain.com>
          * 
          * Recipient address: xxxxx@yourdomain.com
          * Reason: Over quota
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_SOFT,
             'regex'         => "/over.*quota/i"
         ),
         
         /**
          * Triggered by:
          * 
          * Sorry the recipient quota limit is exceeded.
          * This message is returned as an error.
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_SOFT,
             'regex'         => "/quota.*exceeded/i"
         ),
         
         /**
          * Triggered by:
          * 
          * The user to whom this message was addressed has exceeded the allowed mailbox
          * quota. Please resend the message at a later time.
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_SOFT,
             'regex'         => "/exceed.*\n?.*quota/i"
         ),
         
         /**
          * Triggered by:
          * 
          * Failed to deliver to '<xxxxx@yourdomain.com>'
          * LOCAL module(account xxxxxx) reports:
          * account is full (quota exceeded)
          * 
          * Error in fabiomod_sql_glob_init: no data source specified - database access disabled
          * [Fri Feb 17 23:29:38 PST 2006] full error for caltsmy:
          * that member's mailbox is full
          * 550 5.0.0 <xxxxx@yourdomain.com>... Can't create output
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_SOFT,
             'regex'         => "/(?:alias|account|recipient|address|email|mailbox|user).*full/i"
         ),
         
         /**
          * Triggered by:
          * 
          * gaosong "(0), ErrMsg=Mailbox space not enough (space limit is 10240KB)
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_SOFT,
             'regex'         => "/space.*not.*enough/i"
         ),
         
         /**
          * Triggered by:
          * 
          * ----- Transcript of session follows -----
          * xxxxx@yourdomain.com... Deferred: Connection refused by nomail.tpe.domain.com.
          * Message could not be delivered for 5 days
          * Message will be deleted from queue
          * 
          * 451 4.4.1 reply: read error from www.domain.com.
          * xxxxx@yourdomain.com... Deferred: Connection reset by www.domain.com.
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_SOFT,
             'regex'         => "/Deferred.*Connection (?:refused|reset)/i"
         ),
         
         /**
          * Triggered by:
          * 
          * ----- The following addresses had permanent fatal errors -----
          * Tan XXXX SSSS <xxxxx@yourdomain..com>
          * ----- Transcript of session follows -----
          * 553 5.1.2 XXXX SSSS <xxxxx@yourdomain..com>... Invalid host name
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/Invalid host name/i"
         ),
         
         /**
          * Triggered by:
          * 
          * ----- Transcript of session follows -----
          * xxxxx@yourdomain.com... Deferred: mail.domain.com.: No route to host
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/Deferred.*No route to host/i"
         ),
         
         /**
          * Triggered by:
          * 
          * ----- Transcript of session follows -----
          * 550 5.1.2 xxxxx@yourdomain.com... Host unknown (Name server: .: no data known)
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/Host unknown/i"
         ),
         
         /**
          * Triggered by:
          * 
          * ----- Transcript of session follows -----
          * 451 HOTMAIL.com.tw: Name server timeout
          * Message could not be delivered for 5 days
          * Message will be deleted from queue
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/Name server timeout/i"
         ),
         
         /**
          * Triggered by:
          * 
          * ----- Transcript of session follows -----
          * xxxxx@yourdomain.com... Deferred: Connection timed out with hkfight.com.
          * Message could not be delivered for 5 days
          * Message will be deleted from queue
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/Deferred.*Connection.*tim(?:e|ed).*out/i"
         ),
         
         /**
          * Triggered by:
          * 
          * ----- Transcript of session follows -----
          * xxxxx@yourdomain.com... Deferred: Name server: domain.com.: host name lookup failure
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/Deferred.*host name lookup failure/i"
         ),
         
         /**
          * Triggered by:
          * 
          * ----- Transcript of session follows -----^M
          * 554 5.0.0 MX list for znet.ws. points back to mail01.domain.com^M
          * 554 5.3.5 Local configuration error^M
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/MX list.*point.*back/i"
         ),
         
         /**
          * Triggered by:
          * 
          * ----- Transcript of session follows -----
          * 451 4.0.0 I/O error
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_SOFT,
             'regex'         => "/I\/O error/i"
         ),
         
         /**
          * Triggered by:
          * 
          * Failed to deliver to 'xxxxx@yourdomain.com'^M
          * SMTP module(domain domain.com) reports:^M
          * connection with mx1.mail.domain.com is broken^M
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_SOFT,
             'regex'         => "/connection.*broken/i"
         ),
         
         /**
          * Triggered by:
          * 
          * Delivery to the following recipients failed.
          * xxxxx@yourdomain.com
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/Delivery to the following recipients failed/i"
         ),
         
         /**
          * Triggered by:
          * 
          * ----- The following addresses had permanent fatal errors -----^M
          * <xxxxx@yourdomain.com>^M
          * (reason: User unknown)^M
          * 
          * 550 5.1.1 xxxxx@yourdomain.com... User unknown^M
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/User unknown/i"
         ),
         
         /**
          * Triggered by:
          * 
          * 554 5.0.0 Service unavailable
          */
         array(
             'bounceType'    => BounceHandler::BOUNCE_HARD,
             'regex'         => "/Service unavailable/i"
         ),    
    ),
    
    BounceHandler::BODY_RULES => array(
        
        /**
         * Triggered by:
         * 
         * xxxxx@yourdomain.com
         * no such address here
         */
         array(
             'bounceType'       => BounceHandler::BOUNCE_HARD,
             'regex'            => "/(\S+@\S+\w).*\n?.*no such address here/i",
             'regexEmailIndex'  => 1,
         ),
         
         /**
          * Triggered by:
          * 
          * <xxxxx@yourdomain.com>:
          * 111.111.111.111 does not like recipient.
          * Remote host said: 550 User unknown
          */
         array(
             'bounceType'       => BounceHandler::BOUNCE_HARD,
             'regex'            => "/<(\S+@\S+\w)>.*\n?.*\n?.*user unknown/i",
             'regexEmailIndex'  => 1,
         ),
         
         /**
          * Triggered by:
          * 
          * <xxxxx@yourdomain.com>:
          * Sorry, no mailbox here by that name. vpopmail (#5.1.1)
          */
         array(
             'bounceType'       => BounceHandler::BOUNCE_HARD,
             'regex'            => "/<(\S+@\S+\w)>.*\n?.*no mailbox/i",
             'regexEmailIndex'  => 1,
         ),
         
         /**
          * Triggered by:
          * 
          * xxxxx@yourdomain.com<br>
          * local: Sorry, can't find user's mailbox. (#5.1.1)<br>
          */
         array(
             'bounceType'       => BounceHandler::BOUNCE_HARD,
             'regex'            => "/(\S+@\S+\w)<br>.*\n?.*\n?.*can't find.*mailbox/i",
             'regexEmailIndex'  => 1,
         ),
         
         /**
          * Triggered by:
          * 
          * (reason: Can't create output)
          * (expanded from: <xxxxx@yourdomain.com>)
          */
         array(
             'bounceType'       => BounceHandler::BOUNCE_HARD,
             'regex'            => "/Can't create output.*\n?.*<(\S+@\S+\w)>/i",
             'regexEmailIndex'  => 1,
         ),
         
         /**
          * Triggered by:
          * 
          * ????????????????:
          * xxxxx@yourdomain.com : ????, ?????.
          */
         array(
             'bounceType'       => BounceHandler::BOUNCE_HARD,
             'regex'            => "/(\S+@\S+\w).*=D5=CA=BA=C5=B2=BB=B4=E6=D4=DA/i",
             'regexEmailIndex'  => 1,
         ),
         
         /**
          * Triggered by:
          * 
          * xxxxx@yourdomain.com
          * Unrouteable address
          */
         array(
             'bounceType'       => BounceHandler::BOUNCE_HARD,
             'regex'            => "/(\S+@\S+\w).*\n?.*Unrouteable address/i",
             'regexEmailIndex'  => 1,
         ),
         
         /**
          * Triggered by:
          * 
          * Delivery to the following recipients failed.
          * xxxxx@yourdomain.com
          */
         array(
             'bounceType'       => BounceHandler::BOUNCE_HARD,
             'regex'            => "/delivery[^\n\r]+failed\S*\s+(\S+@\S+\w)\s/is",
             'regexEmailIndex'  => 1,
         ),
         
         /**
          * Triggered by:
          * 
          * A message that you sent could not be delivered to one or more of its^M
          * recipients. This is a permanent error. The following address(es) failed:^M
          * ^M
          * xxxxx@yourdomain.com^M
          * unknown local-part "xxxxx" in domain "yourdomain.com"^M
          */
         array(
             'bounceType'       => BounceHandler::BOUNCE_HARD,
             'regex'            => "/(\S+@\S+\w).*\n?.*unknown local-part/i",
             'regexEmailIndex'  => 1,
         ),
         
         /**
          * Triggered by:
          * 
          * <xxxxx@yourdomain.com>:^M
          * 111.111.111.11 does not like recipient.^M
          * Remote host said: 550 Invalid recipient: <xxxxx@yourdomain.com>^M
          */
         array(
             'bounceType'       => BounceHandler::BOUNCE_HARD,
             'regex'            => "/Invalid.*(?:alias|account|recipient|address|email|mailbox|user).*<(\S+@\S+\w)>/i",
             'regexEmailIndex'  => 1,
         ),
         
         /**
          * Triggered by:
          * 
          * Sent >>> RCPT TO: <xxxxx@yourdomain.com>^M
          * Received <<< 550 xxxxx@yourdomain.com... No such user^M
          * ^M
          * Could not deliver mail to this user.^M
          * xxxxx@yourdomain.com^M
          * *****************     End of message     ***************^M
          */
         array(
             'bounceType'       => BounceHandler::BOUNCE_HARD,
             'regex'            => "/\s(\S+@\S+\w).*No such.*(?:alias|account|recipient|address|email|mailbox|user)>/i",
             'regexEmailIndex'  => 1,
         ),
         
         /**
          * Triggered by:
          * 
          * <xxxxx@yourdomain.com>:^M
          * This address no longer accepts mail.
          */
         array(
             'bounceType'       => BounceHandler::BOUNCE_HARD,
             'regex'            => "/<(\S+@\S+\w)>.*\n?.*(?:alias|account|recipient|address|email|mailbox|user).*no.*accept.*mail>/i",
             'regexEmailIndex'  => 1,
         ),
         
         /**
          * Triggered by:
          * 
          * <xxxxx@yourdomain.com>:
          * This account is over quota and unable to receive mail.
          * 
          * <xxxxx@yourdomain.com>:
          * Warning: undefined mail delivery mode: normal (ignored).
          * The users mailfolder is over the allowed quota (size). (#5.2.2)
          */
         array(
             'bounceType'       => BounceHandler::BOUNCE_SOFT,
             'regex'            => "/<(\S+@\S+\w)>.*\n?.*\n?.*over.*quota/i",
             'regexEmailIndex'  => 1,
         ),
         
         /**
          * Triggered by:
          * 
          *   ----- Transcript of session follows -----
          * mail.local: /var/mail/2b/10/kellen.lee: Disc quota exceeded
          * 554 <xxxxx@yourdomain.com>... Service unavailable
          */
         array(
             'bounceType'       => BounceHandler::BOUNCE_SOFT,
             'regex'            => "/quota exceeded.*\n?.*<(\S+@\S+\w)>/i",
             'regexEmailIndex'  => 1,
         ),
         
         /**
          * Triggered by:
          * 
          * Hi. This is the qmail-send program at 263.domain.com.
          * <xxxxx@yourdomain.com>:
          * - User disk quota exceeded. (#4.3.0)
          */
         array(
             'bounceType'       => BounceHandler::BOUNCE_SOFT,
             'regex'            => "/<(\S+@\S+\w)>.*\n?.*quota exceeded/i",
             'regexEmailIndex'  => 1,
         ),
         
         /**
          * Triggered by:
          * 
          * xxxxx@yourdomain.com
          * mailbox is full (MTA-imposed quota exceeded while writing to file /mbx201/mbx011/A100/09/35/A1000935772/mail/.inbox):
          */
         array(
             'bounceType'       => BounceHandler::BOUNCE_SOFT,
             'regex'            => "/\s(\S+@\S+\w)\s.*\n?.*mailbox.*full/i",
             'regexEmailIndex'  => 1,
         ),
         
         /**
          * Triggered by:
          * 
          * The message to xxxxx@yourdomain.com is bounced because : Quota exceed the hard limit
          */
         array(
             'bounceType'       => BounceHandler::BOUNCE_SOFT,
             'regex'            => "/The message to (\S+@\S+\w)\s.*bounce.*Quota exceed/i",
             'regexEmailIndex'  => 1,
         ),
         
         /**
          * Triggered by:
          * 
          * xxxxx@yourdomain.com<br>
          * 553 user is inactive (eyou mta)
          */
         array(
             'bounceType'       => BounceHandler::BOUNCE_HARD,
             'regex'            => "/(\S+@\S+\w)<br>.*\n?.*\n?.*user is inactive/i",
             'regexEmailIndex'  => 1,
         ),
         
         /**
          * Triggered by:
          * 
          * xxxxx@yourdomain.com [Inactive account]
          */
         array(
             'bounceType'       => BounceHandler::BOUNCE_HARD,
             'regex'            => "/(\S+@\S+\w).*inactive account/i",
             'regexEmailIndex'  => 1,
         ),
         
         /**
          * Triggered by:
          * 
          * <xxxxx@yourdomain.com>:
          * Unable to switch to /var/vpopmail/domains/domain.com: input/output error. (#4.3.0)
          */
         array(
             'bounceType'       => BounceHandler::BOUNCE_HARD,
             'regex'            => "/<(\S+@\S+\w)>.*\n?.*input\/output error/i",
             'regexEmailIndex'  => 1,
         ),
         
         /**
          * Triggered by:
          * 
          * <xxxxx@yourdomain.com>:
          * can not open new email file errno=13 file=/home/vpopmail/domains/fromc.com/0/domain/Maildir/tmp/1155254417.28358.mx05,S=212350
          */
         array(
             'bounceType'       => BounceHandler::BOUNCE_HARD,
             'regex'            => "/<(\S+@\S+\w)>.*\n?.*can not open new email file/i",
             'regexEmailIndex'  => 1,
         ),
         
         /**
          * Triggered by:
          * 
          * <xxxxx@yourdomain.com>:
          * 111.111.111.111 failed after I sent the message.
          * Remote host said: 451 mta283.mail.scd.yahoo.com Resources temporarily unavailable. Please try again later [#4.16.5].
          */
         array(
             'bounceType'       => BounceHandler::BOUNCE_SOFT,
             'regex'            => "/<(\S+@\S+\w)>.*\n?.*\n?.*Resources temporarily unavailable/i",
             'regexEmailIndex'  => 1,
         ),
         
         /**
          * Triggered by:
          * 
          * AutoReply message from xxxxx@yourdomain.com
          */
         array(
             'bounceType'       => BounceHandler::BOUNCE_SOFT,
             'regex'            => "/^AutoReply message from (\S+@\S+\w)/i",
             'regexEmailIndex'  => 1,
         ),
         
         /**
          * Triggered by:
          * 
          * <xxxxx@yourdomain.com>:
          * The user does not accept email in non-Western (non-Latin) character sets.
          */
         array(
             'bounceType'       => BounceHandler::BOUNCE_HARD,
             'regex'            => "/<(\S+@\S+\w)>.*\n?.*does not accept[^\r\n]*non-Western/i",
             'regexEmailIndex'  => 1,
         ),
    ),
    
    /**
     * Following are generic rules that should be applied at the end of the checks.
     * 
     */
    BounceHandler::COMMON_RULES => array(

        /**
         * Triggered by:
         * 
         * user has Exceeded
         * exceeded storage allocation
         */
        array(
            'bounceType'    => BounceHandler::BOUNCE_SOFT,
            'regex'         => "/(user\shas\s)?exceeded(\s+storage\sallocation)?/i",
        ),
        
        /**
         * Triggered by:
         * 
         * Mailbox full
         * mailbox is full
         * Mailbox quota usage exceeded
         * Mailbox size limit exceeded
         **/
        array(
            'bounceType'    => BounceHandler::BOUNCE_SOFT,
            'regex'         => "/mail(box|folder)(\s+)?(is|full|quota|size)(\s+)?(full|usage|limit)?(\s+)?(exceeded)?/i",
        ),
        
        /**
         * Triggered by:
         * 
         * Quota full
         * Quota violation
         **/
        array(
            'bounceType'    => BounceHandler::BOUNCE_SOFT,
            'regex'         => "/quota\s(full|violation)/i",
        ),
        
        /**
         * Triggered by:
         * 
         * User has exhausted allowed storage space
         * User mailbox exceeds allowed size
         * User has too many messages on the server
         */
        array(
            'bounceType'    => BounceHandler::BOUNCE_SOFT,
            'regex'         => "/User\s(has|mail(box|folder))\s+((exhausted|exceeds)\sallowed\s(size|.*space)|(too\smany.*server))/i",
        ),
        
        /**
         * Triggered by:
         * 
         * delivery temporarily suspended
         * Delivery attempts will continue to be made for
         */
        array(
            'bounceType'    => BounceHandler::BOUNCE_SOFT,
            'regex'         => "/delivery\s(temporarily\ssuspended|attempts\swill\scontinue\sto\sbe\smade\sfor)/i",
        ),
        
        /**
         * Triggered by:
         * 
         * Greylisting in action
         * Greylisted for 5 minutes
         */
        array(
            'bounceType'    => BounceHandler::BOUNCE_SOFT,
            'regex'         => "/greylist(ing|ed)\s(in|for)\s(\w+(\sminutes)?)/i",
        ),
        
        /**
         * Triggered by:
         * 
         * Server busy
         * server too busy
         * system load is too high
         */
        array(
            'bounceType'    => BounceHandler::BOUNCE_SOFT,
            'regex'         => "/(server|system)\s(load\sis\s)?(too\s)?(busy|high)/i",
        ),
        
        /**
         * Triggered by:
         * 
         * too busy to accept mail
         * too many connections
         * too many sessions
         * Too much load
         */
        array(
            'bounceType'    => BounceHandler::BOUNCE_SOFT,
            'regex'         => "/too\s(busy|many|much)\s(to\saccept\smail|connections?|sessions?|load)/i",
        ),
        
        /**
         * Triggered by:
         * 
         * temporarily deferred
         * temporarily unavailable
         */
        array(
            'bounceType'    => BounceHandler::BOUNCE_SOFT,
            'regex'         => "/temporarily\s(deferred|unavailable)/i",
        ),
        
        /**
         * Triggered by:
         * 
         * Try later
         * retry timeout exceeded
         * queue too long
         */
        array(
            'bounceType'    => BounceHandler::BOUNCE_SOFT,
            'regex'         => "/try\slater|retry\stimeout\sexceeded|queue\stoo\slong/i",
        ),
        
        // some hard bounce foreigh messages
        
        // box full
        array(
            'bounceType'    => BounceHandler::BOUNCE_SOFT,
            'regex'         => "/Benutzer\shat\szuviele\sMails\sauf\sdem\sServer/i",
        ),
        
        // unknown user
        array(
            'bounceType'    => BounceHandler::BOUNCE_HARD,
            'regex'         => "/destin\.\sSconosciuto/i",
        ),
        
        // unknown
        array(
            'bounceType'    => BounceHandler::BOUNCE_HARD,
            'regex'         => "/Destinatario\serrato/i",
        ),
        
        // unknown
        array(
            'bounceType'    => BounceHandler::BOUNCE_HARD,
            'regex'         => "/Destinatario\ssconosciuto\so\smailbox\sdisatttivata/i",
        ),
        
        // unknown
        array(
            'bounceType'    => BounceHandler::BOUNCE_HARD,
            'regex'         => "/Indirizzo\sinesistente/i",
        ),
        
        // unknown
        array(
            'bounceType'    => BounceHandler::BOUNCE_HARD,
            'regex'         => "/nie\sistnieje/i",
        ),
        
        // unknown
        array(
            'bounceType'    => BounceHandler::BOUNCE_HARD,
            'regex'         => "/Nie\sma\stakiego\skonta/i",
        ),
        
        // expired
        array(
            'bounceType'    => BounceHandler::BOUNCE_HARD,
            'regex'         => "/Esta\scasilla\sha\sexpirado\spor\sfalta\sde\suso/i",
        ),
        
        // disabled
        array(
            'bounceType'    => BounceHandler::BOUNCE_HARD,
            'regex'         => "/Adressat\sunbekannt\soder\sMailbox\sdeaktiviert/i",
        ),
        
        // disabled
        array(
            'bounceType'    => BounceHandler::BOUNCE_HARD,
            'regex'         => "/Destinataire\sinconnu\sou\sboite\saux\slettres\sdesactivee/i",
        ),
        
        // inactive
        array(
            'bounceType'    => BounceHandler::BOUNCE_HARD,
            'regex'         => "/El\susuario\sesta\sen\sestado:\sinactivo/i",
        ),
        
        // inactive
        array(
            'bounceType'    => BounceHandler::BOUNCE_HARD,
            'regex'         => "/Podane\skonto\sjest\szablokowane\sadministracyjnie\slub\snieaktywne/i",
        ),
        
        // inactive
        array(
            'bounceType'    => BounceHandler::BOUNCE_HARD,
            'regex'         => "/Questo\sindirizzo\se'\sbloccato\sper\sinutilizzo/i",
        ),
        
        // spam
        array(
            'bounceType'    => BounceHandler::BOUNCE_HARD,
            'regex'         => "/Wiadomosc\szostala\sodrzucona\sprzez\ssystem\santyspamowy/i",
        ),
    )
);