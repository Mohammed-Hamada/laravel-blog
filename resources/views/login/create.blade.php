<x-layout>
  <section class="px-6 py-8">
      <main class="max-w-lg mx-auto">
          <form action="/login" method="POST">
              @csrf
              <div class="mb-6">
                  <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="email">Email</label>
                  <input class="border border-gray-400 p-2 w-full" type="email" name="email" id="email"
                      value="{{ old('email') }}" required>
                  @error('email')
                      <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                  @enderror
              </div>
              <div class="mb-6">
                  <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="password">Password</label>
                  <input class="border border-gray-400 p-2 w-full" type="password" name="password" id="password"
                      required>
                  @error('password')
                      <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                  @enderror
              </div>
              <div class="mb-6">
                  <button class="bg-blue-400 border border-gray-400 p-2 rounded text-white"
                      type="submit">Submit</button>
              </div>
          </form>
      </main>
  </section>
</x-layout>
