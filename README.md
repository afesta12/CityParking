# Wonderville Parking Management System

Wonderville Parking Management System is a web application built using MySQL, PHP, and TailwindCSS as the final project for CSE 3241.

* Basic User Functionality

    A user can reserve a parking spot on any day there is an event in the city of Wonderville, look up their reservation, and delete their reservation within certain constraints.

* Basic Admin Functionality

    An admin user can create, edit, and remove zones within the city of Wonderville, and they can generate a revenue report or a summary of all their zones.

---

## Getting Started

### Installation

* For the local installation (install PHP and MySQL directly on your computer):
    The Wonderville City Parking Manager can be used by following these steps:
  1. Make sure that mysqli is enabled by uncommenting the line `;extension=mysqli` in your _php.ini_ file. 
  2. Download the `GroupProject.zip` and put this file under `C:\`.
  3. Unzip the `GroupProject.zip`.
  4. Start your PHP server:  
      a. Open a terminal.  
      b. CD into the `GroupProject` folder.  
      c. Run the following command with your port number of choice to run the PHP server:
           ```
         C:\PHP\php.exe -S localhost:8080
         ```
  5. Initialize MySQL schema and insert test data:  
      a. Open your browser.  
      b. Paste the following link in the URL bar to create and insert relevant schema and testing data.  
           ```
         http://localhost:8080/Install/install.php
         ```  
        c. Later, the page will let you know that the City Parking database was created and is ready to use.
  6. Navigate to the following link:
      ```
      http://localhost:8080/PHP/index.php
      ```
  7. From there the database is set up and ready to use.

* For the Docker version setting:  
  Please refer to the following video and documentation links  
  [Docker documentation tutor](https://docs.google.com/document/d/16U9BM6RFqO6gn4vrq0chD8hIBjz0yG9TfKZV0g5ChBU/edit)  
  [Docker video tutor](https://www.loom.com/share/e530ccd899044ebcb06d328edb49bd89?sid=771870c3-dc17-4deb-b485-0a9a1cc3a18e)  

---

## How to Use?

### In-Depth User Functionality

#### - Reserve Your Spot

A user can enter their name, cellphone, and a date to reserve a parking spot. Note that reservations must be made at least one day in advance, and a lot must have spots available on the chosen date.

#### - Search Available Zones

A user can select an available zone to reserve their spot in. Note that the zones that appear are ones with available spots and are offered by lots on the chosen date. Available zones are shown in the table consisting of:

  * Zone Number
  * Number of Available Spots
  * Rate/hr

Once the user submits a zone, a confirmation page appears with their associated confirmation number.

#### - Search Distance Between Zones and Venues

A user can select an available zone that appears in the table, similar to Search Available Zones, but they can also select a venue to see the distance between the selected zone and venue.

#### - See Your Reservations

A user can enter their phone number or confirmation number to see their past and present reservations. Reservations are shown in a table consisting of:

  * Name
  * Phone Number
  * Confirmation Number
  * User Number
  * Zone Number
  * Date
  * Rate/hr
  * Status

A user can also select a confirmation number from their reservations to cancel it. Once canceled, the status for the associated reservation will change to "Cancelled".

### In-Depth Admin Functionality
    
#### - Admin Login 

The admin of Wonderville Parking can log in with the username and password combination of "admin" & "admin123".

#### - Admin Dashboard

The admin dashboard consists of an input field where the admin may enter a date or range of dates (entering the same date twice results in a single date) to display a listing consisting of:
        
  * Zone and Date
  * Total number of designated spots remaining
  * The rate
  * Number of reservable spots taken in that zone

#### - Add a Zone

The admin can add a zone via the add zone page located in the header of the admin dashboard. To add a zone, the admin must enter the following:

  * The date of the event
  * The name of the zone (zone number will be found from name)
  * The number of reservable spots for that date/event combination
  * The rate for the reservable spaces

After entering this information, the zone is added and the admin is directed back to the admin dashboard.
  
#### - Remove A Zone

The admin can remove a zone via the remove a zone page. To remove a zone, the admin must enter the following:

  * The date
  * The zone's number
  
After entering this information, checks are made to ensure that no reservations are made on the date entered by the admin in that zone. If the checks go through, the zone will be removed by setting the number of available reservation spaces to 0. This ensures that a user is able to check on their past reservations.

#### - Update A Zone

The admin can update a zone via the update zone page. To update a zone, the admin must enter the following:

  * The date
  * The zone number
  * The new number of available spaces
  * The new rate

After entering this information, checks are made to ensure that no reservations will be ruined via this update. If the checks go through, a new number of available spaces will be made available (or spaces taken away) and a new rate will be put into place.

#### - Admin Revenue Report

The admin revenue report consists of an input field where the admin may enter a date to display a listing consisting of:
        
  * Zone and Date
  * Total number of designated spots remaining
  * Number of reservations
  * The rate
  * The total revenue from that zone on the entered date

---
## Database diagram
![ER.jpg](https://media.discordapp.net/attachments/1164679951858008136/1178912932592107561/IMG_0983.png?ex=6577df3a&is=65656a3a&hm=cabd4356981794dc5ef644d8676e6f39aa5479633a38ecb80e4cae968764da40&=&format=webp&width=764&height=354)




---
## Contributors

  #### Maddi Lewis 
  * HTML
  * PHP on user pages
  * Frontend user functionality

  #### Terry Liu
  * MySQL review
  * PHP review
  * Backend coding
  * Docker-related feature coding
   
  #### Andrew Festa
  * HTML
  * Styling
  * General PHP on admin pages
  * Frontend admin functionality
  
  #### Kai Lun Lin
  * Design database schema
  * Design SQL queries to retrieve data
  * Initialization SQL file coding
