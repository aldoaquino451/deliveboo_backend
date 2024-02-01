Deliveboo 
===

- App\Http\Controllers\Auth\AuthenticatedSessionController.php 
- destroy()
- return redirect('http://localhost:5174/');

- Stripe: alternativa a Braintree


### To Do List - 25/01 

**Front End**
  - Controlla la validazione della mail nella pagina di pagamento (aggiungi virgola punto e parentesi tonde)
  - Pagamento, sistemare carrello temporaneo
  - Loader (facoltativo)

**Back End**
  - Nella Dashboard aggiungere nome indirizzo e email utente

**Presentazione**
  - Trova software per presentazione su dispositivo mobile (Screen Fly)
  - Preparare un block note con i dati da inserire come test dentro al form
  - Ricorda di usare modalità incognita per evitare autocompilazione


### To Fix 28/01

  - Far stampare correttamente la quantità dei prodotti ordinati nel PostPayment
  - Far stampare correttamente la quantità dei prodotti ordinati e sistemare le informazione da mandare via mail al cliente e al ristoratore (view/mail/)
  - Sistemare il numero di ordine da passare al postPayment per stampare i dati dell'ultimo ordine del database
  - Far partire la creazione dell'ordine nel database solo dopo il aver completato il pagamento


lancia composer install per installare le altre dipendenze

da modifcare questa parte:
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=e6ae69374cf9c8
MAIL_PASSWORD=1cb316186bb516
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

0. 
1. home:
  - logo 
  - titolo 
  - utente
  - carrello
  - tipologie hover/active
  - ristoranti generici/specifici
    - immagine
    - titolo
    - tipoogie 
  - paginazione
  - 
2. fai l'ordine validazione pagamento 
  - selezionare il ristorante dalla home
  - visualizza i prodotti
  - mostrare solo prodotti per categoria
  - aprire nuovo ristorante per scegliere un modale ristorante sbagliato 
  - svuotare il carrello con modale svuota e elimina
  - validazione form
  - pagamento

selezionato il ristorante... 