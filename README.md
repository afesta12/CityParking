# Wonderville Parking Management System

Wonderville Parking Management System is a web application built using MySQL, PHP and TailwindCSS as
the final project for CSE 3241. 

* Basic User Functionality

    A user can reserve a parking spot on any day there is an event in the city of Wonderville,
    look up their reservation and delete their reservation within certain constraits. 

* Basic Admin Functionality

    An admin user can create, edit and remove zones within the city of Wonderville, and they can generate
    a revenue report or a summary of all of their zones.

## Description

### In Depth User Functionality

#### Reserve Your Spot

A user can enter in their name, cellphone, and a date to reserve a parking spot. Note that reservations must be made at least one day in advance, and a lot must reserve spots on the chosen date.

#### Search Available Zones

A user can select an available zone to reserve their spot in. Note that the zones that appear are ones with available spots and ones that are offered by lots on the chosen date. Available zones are shown in the table that consists of:

  * Zone Number
  * Number of Available Spots
  * Rate/hr

Once the user submits a zone, a confirmation page appears with their associated confirmation number.

#### Search Distance Between Zones and Venues

A user can select an available zone that appears in the table, similar to Search Available Zones, but they can also select a venue to see the distance between the selected zone and venue.

#### See Your Reservations

A user can enter their number or confirmation number to see their past and present reservations. Reservations are shown in the table that consists of:

  * Name
  * Phone Number
  * Confirmation Number
  * User Number
  * Zone Number
  * Date
  * Rate/hr
  * Status

A user can also select a confirmation number from their reservations to cancel it. Once cancelled, the status for the associated reservation will change to "Cancelled".

### In Depth Admin Functionality
    
#### Admin Login 

The admin of Wonderville Parking can log in with the username and password combination of "admin" & "admin123".

#### Admin Dashboard

The admin dashboard consists of an input field where the admin may enter a date or range of dates (same date entered twice results in a single date) in order to display a listing consisting of:
        
  * Zone and Date
  * Total number of designated spots
  * The rate
  * Number of reservable spots taken in that zone

#### Add a zone

The admin can add a zone via the add zone page located in the header of the admin dashboard. In order to add a zone, the admin must enter the following:

  * The date of the event
  * The name of the zone
  * The zone's capacity (total number of spaces in the zone)
  * The number of reservable spots for that date / event combination
  * The rate for the reservable spaces
  * The venue's name
  * The distance between the lot and the venue

After entering this information, the zone is added and given a unique zone ID number and the admin is directed back to the admin dashboard.
  
#### Remove A Zone

The admin can remove a zone via the remove a zone page. In order to remove a zone the admin must enter the following:

  * The date
  * The zone's number
  
After entering this information, checks are made to ensure that no reservations are made on the date entered by the admin in that zone. If the checks go through, the zone will be removed by setting the number of available reservation spaces to 0. This ensures that a user is able to check on their past reservations.

#### Update A Zone

The admin can update a zone via the update zone page. In order to update a zone, the admin must enter the following:

* The date
* The zone number
* The new number of available spaces
* The new rate

After entering this information, checks are made to ensure that no reservations will be ruined via this update. If the checks go through, a new number of available spaces will be made available (or spaces taken away) and a new rate will be put into place.

#### Admin Revenue Report

The admin revenue report consists of an input field where the admin may enter a date in order to display a listing consisting of:
        
  * Zone and Date
  * Total number of designated spots
  * Number of reservations
  * The rate
  * The total revenue from that zone on the entered date

## Getting Started

### Installing

* For the docker version setting:
  Please refer to the following video and documentation links:<br>
  [Docker documentation tutor](https://docs.google.com/document/d/16U9BM6RFqO6gn4vrq0chD8hIBjz0yG9TfKZV0g5ChBU/edit)<br>
  [Docker video tutor](https://www.loom.com/share/e530ccd899044ebcb06d328edb49bd89?sid=771870c3-dc17-4deb-b485-0a9a1cc3a18e)<br>

### Executing program

* Include step by step processes for anything that isn't 
  super obvious on the site

## Authors

  ### Maddi Lewis 

  ### Terry Liu
  * Database review
  * PHP reivew
  * Backend coding
  * Docker-related feature coding
   
  ### Andrew Festa
  * HTML
  * Styling
  * General PHP on admin pages
  * Frontend admin functionality
  
  ### Kai Lun Lin
  * Design database schema
  * Some queries to retrive data
