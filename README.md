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

