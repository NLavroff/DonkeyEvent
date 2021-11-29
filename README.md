GIT

To download the very latest source off the GIT server do this :

git clone git@github.com:Nathboule/DonkeyEvent.git

(you'll get a directory named DonkeyEvent created, filled with the source code)

CREATE DATABASE

Open Shell and launch command :

mysql -u root

Launch commands :

CREATE DATABASE donkey_event_db;

USE donkey_event_db;

IMPORT DATABASE

Open Workbench

Go to Administration

Click on Data Import

Select dumps folder in Donkey Event

Click on donkey_event_db

Star Import

LAUNCH WEBSITE

Open Shell and launch command :

php -S localhost:8000

LOGIN TO SESSION

Click on "Se connecter"

Fill user field : 
Guest

Fill password field : 
1234

Click on "Connexion"

ENJOY YOUR NAVIGATION !

-------------------------------------------------------
# DonkeyEvent

Projet PHP - JS
Date : du 12 Novembre au 26 Novembre
Créer un site de réservation
Dans les quêtes précédentes, vous avez découvert PHP et commencé pour certains la POO (Programmation Orienté Objet). Un nouveau mois démarre… Qui dit nouveau mois dit nouveau langage (ou presque...) ! 
Du 12 novembre au 21 novembre, nous vous proposons de commencer les quêtes sur Javascript et en parallèle travailler sur le projet que nous vous proposons. 
Vous avez commencé petit à petit à engranger pas mal de notions ! Rappelez-vous du premier jour… Aujourd’hui vous savez ce qu’est une variable, un tableau, un objet, des instances, des classes, une BDD et j’en passe... 
Le chemin de Stevenson est néanmoins encore loin d’être fini… nous sommes à ¼ du chemin parcouru, tenez bon ! Cela va vite mais pas de panique vous continuerez à mettre en pratique les différentes notions que vous avez rencontrées lors de votre parcours lors des missions que nous allons vous proposer. 
 
SUJET : 
Du 12 au 26 Novembre, vous aurez pour mission de créer un site de réservation de votre choix. 
Vous aurez le choix entre : 
- DonkeyAir : réservation de vol d’avion
- DonkeyStay : réservation hotel/appartement
- DonkeyCar : réservation de voiture
- DonkeyEvent : réservation d’une place de cinéma ou autre event

TECHNO : 
Les technos que vous aurez à utiliser sont : 
- PHP ;
- JS ;
- SASS ;
- Bootstrap ;
- BDD ;

CONCEPTION : 
- MCD 
- UX

OUTILS : 
- Workbench, 
- VS Code, 
- GIT, 
- GITHUB, 
- Bash

FEATURES À DÉVELOPPER
CRUD
Page de connexion (pas d’inscription)/déconnexion
Réservation calendrier avec les dates de disponibilités, prix etc…
Différentes options aux choix en fonction du projet (ex: assurance, lavage dernier voiture, assurance annulation, option animaux…)
Barre de recherche
Le site doit être responsive
Mes réservations
Historique de réservation
Bonus : admin

