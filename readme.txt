=== Joget Workflow Inbox Widget ===
Contributors: michaelyap
Donate link: http://www.joget.org/
Tags: widget, sidebar, joget, apps
Requires at least: 3.0
Tested up to: 3.0.4
Stable tag: trunk
License: GPLv2

This plugin connects to a Joget install and displays either an inbox listing of pending tasks and/or an available application list from Joget.

== Description ==

Joget Workflow (www.joget.org) is an open source application builder that helps you build any process-driven web application either by making
it codeless or helping you code less. The JIW (Joget Workflow Inbox Widget) is a WordPress Widget written to connect to any Joget install.
The widget displays a list of pending tasks for a logged in user and/or the list of available applications created from Joget accessible to
the user. Please note that if properly configured, your Joget installation should connect seamlessly to your WordPress deployment, sharing
its users and roles.

Note also that the widget comes with a piece to authenticate users using WordPress' authentication parameters. The piece accepts credential
information and returns a JSON body to mark the authentication results. This function can be used in general terms by any external application
needing to authenticate against WordPress.

For more information about Joget, please visit http://www.joget.org or sign up for our community site at http://dev.joget.org/community.

== Installation ==

1. Upload the Joget Inbox folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Place the Joget Inbox widget in the sidebar (or any visible bar, according to theme).
4. Configure the widget to point to your Joget. By default, the URL should be configured up to your /wflow-wfweb/ (i.e., http://localhost:8080/wflow-wfweb/).
5. Make sure your Joget installation is loaded and configured with the correct WordPress Directory Manager plugin.

Full wiki of setup instructions can be found at http://dev.joget.org/community/display/KB/Wordpress 

== Frequently Asked Questions ==

= What can I build with Joget Workflow ? =
Any process-driven web application. It could be a CRM, ERP or HR management solution, or procurement software. If it's process-driven
or process-centric, Joget will help you build it.

= What technology is Joget Workflow written on? =
Joget is built mostly on a J2EE stack.

= Does that mean that it will not apply to the PHP guys in the WordPress community ? =
Absolutely not. We've designed our integration points to be web technology agnostic. You can do a whole lot with our JSON and REST APIs
without having to ever touch the JAVA suite. The WordPress widget itself is written purely on PHP and JavaScript.

= What if I can also do JAVA ? =
More power to you ! We have a full OSGI implementation that will allow you to build very, very, very cool stuff. We have existing plugins that
can connect to LDAPs or Google Apps, or even make it so that you can send SMS or make calls to phones from your web apps simply by dragging
boxes around on your browser !

= The widget looks weird.. =
Feel free to change it. The jiw.css is packaged with the widget.

= How can I learn more about Joget Workflow ? =
We always welcome new members to our growing community and hope that we can help you build cool stuff. Register and join our community of
developers at http://dev.joget.org/community.

== Changelog ==

= 1.0 =
* Initial version

== Upgrade Notice ==
None yet

== Screenshots ==
None yet