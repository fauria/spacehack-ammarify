SpaceHack Ammarify - Sharing experiences from refugee to refugee.
------

# The event

![SpaceHack logo and partners](https://raw.githubusercontent.com/fauria/spacehack-ammarify/master/pictures/the_event.jpg)

The spacehack event, powered by [Facebook](https://www.facebook.com) took place in Berlin, Germany, between June 4th and 5th 2016. 

It was held in the number 25th of the emblematic Holzmarktstraße street, in a building under construction.

The description of the event stated as follows:

*Together with our partners, [Facebook](https://www.facebook.com), [Techfugees](https://techfugees.com/), [REDI School of Digital Integration](http://www.redi-school.org/), and [Welcome-SE](http://welcomestartup.eu/), we are flying in Europe’s best designers, coders, architects and urban planners (with and without refugee status) to discover how technology can improve living conditions for displaced people around the world.*

Each of the around 250 participants had to apply for admission, before receiving an invitation to the event along with both plane and accommodation tickets.


# Sponsors and media partners

![SpaceHack venue, 25 Holzmarktstraße](https://raw.githubusercontent.com/fauria/spacehack-ammarify/master/pictures/the_venue.jpg)

The main sponsors for the event were:

* [Facebook](https://www.facebook.com)
* [Cisco Systems](http://cisco.com/)
* [Heroku](http://www.heroku.com/)
* [Kontakt.io](http://www.kontakt.io/)
* [Relayr](http://www.relayr.io/)
* [Senic](http://www.senic.com/)
* [Twilio](http://twilio.org/)
* [Planet Labs](http://www.planet.com/)
* [BeaconControl](https://beaconcontrol.io/)
* [Fab Lab Berlin](http://fablab.berlin/)
* [Heureka](http://heureka-conference.com/)
* [Little Sun](http://littlesun.com/)

There were also media partners who covered the event through journalists, photographers and TV camera crews:

* [TechCrunch]()
* [Die Welt](http://www.welt.de/)
* [N24](http://www.n24.de)
* [Silicon Allee](http://www.siliconallee.com/)

# The team

![Team Ammarify](https://raw.githubusercontent.com/fauria/spacehack-ammarify/master/pictures/the_team.jpg)

Meet the team:

* Fernando Álvarez-Uría Torres [in](https://linkedin.com/in/fauria) [t](https://twitter.com/fauria)
* Javier Yuste Garcia [in](https://linkedin.com/in/javieryustegarcia) [t](https://twitter.com/javi21s)
* Matthew Tuusberg [in](https://linkedin.com/in/tuusberg)
* Jose Manzano Patrón [in](https://linkedin.com/in/josepedromanzanopatron)

# Goals

At the beginning of the hackathon, the organization stated that the proposed solution should be based around the concept of **"Space"** in its broader sense. 

It was defined so ambiguously on purpose.

As two of the event partners were involved in beacon technology -Kontakt.io and BeaconControl-, we agreed that our solution will make use of it and address the "Space" concept from the [Physical Web](https://google.github.io/physical-web/) perspective.

# The idea

When the hackathon kicked off, we brainstormed some initial ideas and soon realized that, in order to succeed, we had to integrate actual refugees on our project.

Before coming up with our final idea, we had to pivot a few times over the use of beacons and the actual needs of refugees. 

All of them agreed on bureaucratic burden as one of their main concerns, so we decided to go that way.

Although we could not improve bureaucratic processes, we thought that at least we could improve them by sharing previous experiences, decreasing uncertainty and enabling a communication channel between past, present and future refugees.

The idea was to build a website where former refugees could explain through a video different administrative processes to newcomers, easing the process to them.

That included how to ask for help, which forms were needed and how to fill them, how to move between offices, and in general what to expect from a particular public administration organism and their processes.

Once the video was posted to the website, the user could then request a beacon to be placed in that particular facility, broadcasting the URL to the actual content.

This way, a potential user could download an app, walk into an office, check for contextual information, and if available, get specific content that ideally would make the whole process simpler.

![Ammarify Android App](https://raw.githubusercontent.com/fauria/spacehack-ammarify/master/pictures/gifs/screencast-app.gif)

The name of one of the refugees that help us was Ammar, and so we called our application Ammarify.

# Technology

![Kontakt.io Beacons](https://raw.githubusercontent.com/fauria/spacehack-ammarify/master/pictures/the_technology.jpg)

For testing purposes, we first implemented a trivial BLE Beacon using Eddystone protocol using a Raspberry Pi 3.

It helped us test the idea before unboxing one of the [dev kits](http://developers.kontakt.io/) that Kontakt.io made availbale to the participants.

We also developed an application prototype using [kontakt-beacon-admin-sample-app](https://github.com/kontaktio/kontakt-beacon-admin-sample-app) from Kontakt.io, to test the capabilities of our kits of beacons.

# The prototype

We built a working prototype using a [Wordpress](https://wordpress.org) CMS deployed on [Heroku](https://www.heroku.com/).

We recorded and uploaded to Youtube [an interview with Ammar](https://www.youtube.com/watch?v=L06TTC51yLU), where he explained both in English and Arabic the paperwork needed to rent a room in Berlin.

![Ammarify Android App](https://raw.githubusercontent.com/fauria/spacehack-ammarify/master/pictures/gifs/screencast-web.gif)

After uploading the application to Heroku, we setup two beacons to broadcast two URLs, one for each of the Wordpress pages that embedded the videos.

That way we were able to illustrate the whole flow, form the recording of the video to the request of a new beacon and broadcast and discovery of the corresponding URL.

# The pitch

![Team Ammarify pitching](https://raw.githubusercontent.com/fauria/spacehack-ammarify/master/pictures/the_pitch.jpg)

Our team mate Javier Yuste pitched our project during the 4 minutes slot each team had assigned, earning a big round of applause from the public.

During the next minute, he properly answered the questions raised by the jury, concerning feasibility, scalability and cost.

[Our presentation](https://github.com/fauria/spacehack-ammarify/blob/master/SpaceHack%202016%20-%20Team%20Ammarify.pptx) featured a set of backup slides that supported our position on those topics.

# The jury

![SpaceHack Jury](https://raw.githubusercontent.com/fauria/spacehack-ammarify/master/pictures/the_jury.jpg)

The jury was made up by:

* Joséphine Goube, COO, Techfugees.
* Ahmad Sufian Bayram, Regional Manager MENA & SSA, Techstars.
* Hugo Rubilar Rosales, Business Operations, Planet Labs.
* Anne Riechert, Founder, REDI School.
* Milos Spiridonovic, Head of Startups, Deutsche Bank.

# Awards

![Team Ammarify with Kontakt.io Philipp von Gilsa](https://raw.githubusercontent.com/fauria/spacehack-ammarify/master/pictures/the_award.jpg)

After a process of deliberation, the jury decided to award our team with the Kontakt.io award to the best integration of beacon technology, consisting on three kits of beacons.

Overall, Spacehack 2016 was for us both an excellent initiative and amazing experience. 

We had the opportunity to meet people from different cultures, with many backgrounds to learn and enrich from.

# Press

* Article: http://www.welt.de/wirtschaft/webwelt/article156087994/Diese-Fluechtlinge-koennten-Ihre-neuen-Entwickler-sein.html

---