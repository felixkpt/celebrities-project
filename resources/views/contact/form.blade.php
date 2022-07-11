<form class="form-horizontal  w-full" method="post" action="{{ route('contact') }}">
   @csrf
  <div class="mb-4">
   <label for="Name">Name: </label>
   <input type="text" class="w-full p-1 rounded border border-gray-200 focus:border-blue-400" id="name" placeholder="Name" name="name" required>
  </div>
  <div class="mb-4">
   <label for="email">Email: </label>
   <input type="text" class="w-full p-1 rounded border border-gray-200 focus:border-blue-400" id="email" placeholder="Email" name="email" required>
  </div>
  <div class="mb-4">
   <label for="message">Message: </label>
   <textarea type="text" rows="10" class="w-full p-1 rounded border border-gray-200 focus:border-blue-400" id="message" placeholder="Enter your message here" name="message" required> </textarea>
  </div>
  <div class="mb-4">
    <button type="submit" class="button-default" value="Send">Send</button>
  </div>
</form>