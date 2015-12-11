#Google Auth App Portal

##Introduction

More information about Google Authenticator can be found at http://code.google.com/p/google-authenticator/

##Setup the Web Server

Apachie or IIS
Install PHP
Install Free Radius Lib (Windows DLLs can be found under Supporting items folder)

##Configuring the Application

Modify the config.ini.php file in the root directory and update the path

Modify the includes/config.ini.php file to include the Radius server configuraiton

Modify code/setup.inc.php file to add more Applications

##FreeRadius Server Setup

NTP Time Sync Install (Optional)

```bash
sudo bash
apt-get update
apt-get install ntp
```

##Install FreeRADIUS and other Necessary Packages

```bash
sudo bash
apt-get update
apt-get install build-essential libpam0g-dev freeradius git libqrencode3 
```

##Download Google Authenticator Pam Module Source

```bash
cd ~
git clone https://code.google.com/p/google-authenticator/
cd google-authenticator/libpam/
make
make install
```

##Configure Local Unix Groups

We will need to add a group called 'radius-disabled' to drop users in, when you want to disable access

```bash
addgroup radius-disabled
```

##Configure FreeRADIUS

FreeRADIUS must run as root for this to work.

First, edit /etc/freeradius/radusd.conf

You need to locate the following lines: and then change the user & group lines to look like the following

```bash
#  The server will also try to use "initgroups" to read /etc/groups.
#  It will join all groups where "user" is a member.  This can allow
#  for some finer-grained access controls.
#
user = root
group = root
```

Once you have done this, save and close the file.

Next edit, /etc/freeradius/users

You need to locate the following section and add the following:

```bash
#DEFAULT        Group == "disabled", Auth-Type := Reject
#               Reply-Message = "Your account has been disabled."
#

DEFAULT         Group == "radius-disabled", Auth-Type := Reject
                Reply-Message = "Your account has been disabled."

DEFAULT        Auth-Type := PAM
```

We will start by creating a group that you can add users to and disable their access.

Directly after these lines add the following code:
 
Now, we will add the default rule to use the PAM libraries to authenticate users

Directly after the previous lines of code, add the following:
 
Now edit, /etc/freeradius/sites-enabled/default

Locate the following lines of code:

```bash
authenticate {
        #
        #  PAP authentication, when a back-end database listed
        #  in the 'authorize' section supplies a password.  The
        #  password can be clear-text, or encrypted.
        Auth-Type PAP {
                pap
        }

        #
        #  Most people want CHAP authentication
        #  A back-end database listed in the 'authorize' section
        #  MUST supply a CLEAR TEXT password.  Encrypted passwords
        #  won't work.
        Auth-Type CHAP {
                chap
        }

Uncomment the line with "pam" so it should look like this:

		#
        #  Pluggable Authentication Modules.
        pam
```

##Configure PAM

PAM must be configured to use the local Unix password in combination with the Google Authenticator password.

Edit /etc/pam.d/radiusd
 
We need to comment out all the lines that start with @ and then make it look like following:

```bash
#
# /etc/pam.d/radiusd - PAM configuration for FreeRADIUS
#

# We fall back to the system default in /etc/pam.d/common-*
#

#@include common-auth
#@include common-account
#@include common-password
#@include common-session

auth requisite pam_google_authenticator.so forward_pass
auth required pam_unix.so use_first_pass
#auth required pam_google_authenticator.so secret=/root/.google_authenticator
```

##Setup a User

```bash
adduser testuser
```

choose a easy password to remember, for this example I used "test"

```bash
cd /home/archieg/
su testuser
google-authenticator
```

If everything worked right you should see a QR code being generated. Scan this code with Google Auth app from your smart phone.

##Test your Configuration

service freeradius restart

You will want to use a command called "radtest" to test your configuration.

radtest <username> <unix_password><google_auth> localhost 18120 testing123

testing123 is a default secret for the localhost client, used for testing purposes.  You can find this in /etc
/freeradius/clients.conf

so since archieg’s password is "test" and the current google authenticator key is "696720" our test looks like this:

radtest testuser test696720 localhost 18120 testing123

If it works right, you should get something like this:

##Debugging

If for some strange reason it doesn't work.  You can stop freeradius and start it up in debugging mode like this:

```bash
service freeradius stop
freeradius –XXX
```

Important: Make sure your server’s time is correct, else authentication will fail

##Adding Additional Servers for authentication

Edit the file /etc/freeradius/clients.conf

Add the new server as following

```bash
client client_computer_name {
	ipaddr = 192.168.0.25
	secret = testing123
	require_message_authenticator = no
	nastype = other
}
```

Restart free radius service.

```bash
/etc/init.d/freeredius restart
```
