#Laravel Developer small task
##Preparation
1. Create public repository (Github, Gitlab..)
2. Install latest Laravel and push to your repository
3. For next changes use separate meaningful commits
##Task description
   Create simple application WITHOUT AUTH that has following functionality:
1. Store **teachers**. Seed 10 teachers with factory.
2. Store **students**. Seed 10 students with factory.
3. Store **messages**. Index/Create/Update/Delete/Send .
   There is must be create/edit page where subject and body must be filled.
   Also multiple recipients(from **teachers**, **students**) should be selected just use
   select multiple. Store selected users (**teachers**, **students**) in **message_recipients**
   table. Subject and body(path to file) store in messages table. Store message body
   as html file in `storage/app/messages/` directory.
4. Index page. Messages table. **Title** | **Recipients count** | **Sent (Yes/No)** | **Actions**
   (edit, delete, send)
5. Send action. You have blade template where you put $message->body text. On
   send action you push this Mail message to queue(any driver) and only when queue
   job is successful $message->sent = true; Email should be received by all recipient
   emails.
##Use case
   Create new message (fill subject and body, select 1 teacher and 3 students as recipients),
   save message. Now you see message in the table. Click Send on message
   ($message->sent == false on that moment, message pushed to queue). Refresh the page
   and see that message is sent ($message->sent == true). You check log or mailtrap and see
   4 messages. Profit)
##Database
   **teachers** and **students** tables are the same
* firstname
* lastname
* email
  
**messages**
* subject
* body(path to file)
* sent (bool) show if message sent
message_recipients
* message_id
* recipient (morph) recipient_id, recipient_type

##Recommendations
Don’t care about styles at all. Just use Bootstrap and default tables, inputs...

Think how to optimize your sql queries. Use traits.

Use Mail, Queue. Use as many features as you know.

Use any mail driver, also you can use mailtrap
