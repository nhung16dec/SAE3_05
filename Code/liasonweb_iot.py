# Pour les requêtes web :
import requests

contenu="16;12;1991"
r=requests.get("http://10.11.159.10/sd2a/ttran/eval_iot.php?liste="+contenu) ## A vous de voir quoi faire ici!!

print(contenu)
if r.status_code==200:
    print(" --> Envoi Web REUSSI")
else:
    print(" --> ECHEC d'envoi Web")