## Si bibliothèque pas installée pour la communication série :
# pip install pyserial

import serial.tools.list_ports

liste_ports = serial.tools.list_ports.comports()
nombre_ports = len(liste_ports)

# Pour les requêtes web :
import requests

if(nombre_ports == 0):
    print("Aucun port n'a été trouvé")
    trouve_port=""
elif(nombre_ports == 1):
    # Assignation du port par le seul port trouvé
    trouve_port = liste_ports[0].name
    print("Un port trouvé : ", trouve_port)
else:  # Plusieurs ports disponibles
    print("Port disponibles :")

    for i in range(len(liste_ports)):
        print("Choix n°", i, ":", liste_ports[i].name)

    # Demande à l'utilisateur de choisir un port
    choix_port = input("Choix du numéro pour le port à sélectionner : ")
    trouve_port = liste_ports[int(choix_port)].name

if trouve_port!="":
    print("Ouverture de la communication à 9600 bauds sur le port:",trouve_port)
    arduino = serial.Serial(trouve_port, baudrate=9600)

    print('Connexion au port ' + arduino.name + ' à une vitesse de 9600 bauds')
    import time
    time.sleep(3)

    print("Réinitialisation Arduino...")
    # Réinitialisation
    arduino.setDTR(False)
    time.sleep(0.1)
    arduino.setDTR(True)

    # Vidage du Buffer
    arduino.reset_input_buffer()

    print()

    # Lecture en continu du reste des données
    print("Contenu reçu depuis l'Arduino:")
    while True:  # Boucle infinie, elle est interrompue seulement en cas d'erreur (p.ex. port débranché)
        ligne = arduino.readline().decode("utf-8")
        ligne = ligne[:-2]  # Retrait du '\r\n' de fin de ligne
        print(ligne,end='')

        r=requests.get("http://10.11.159.10/profs/PDISCALA/iutcarca/test_iot.php?valeur="+str(ligne)+"&nom=PROF") ## A vous de voir quoi faire ici!!
        if r.status_code==200:
            print(" --> Envoi Web REUSSI")
        else:
            print(" --> ECHEC d'envoi Web")

    print("Fermeture de la communication sur le port:",trouve_port)
    arduino.close()

## Aller lire le résultat à :
#http://10.11.159.10/profs/PDISCALA/iutcarca/lit_iot.php