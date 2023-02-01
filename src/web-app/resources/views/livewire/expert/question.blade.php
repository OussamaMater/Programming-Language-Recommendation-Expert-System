<div class="flex items-center justify-center h-screen">
    <div class="progress-container fixed-top">
        <span class="progress-bar" style="width: {{ $progress }}%;"></span>
    </div>
    <div>
        <div class="card lg:card-side bg-base-300 shadow-xl">
            <figure class="w-96">
                @if (!empty($result))
                    <img src="{{ Vite::asset('resources/images/' . $languages[$result['language']]['logo']) }}" />
                @else
                    <img src="{{ Vite::asset('resources/images/unkown-logo.png') }}" />
                @endif
            </figure>
            <div class="card-body lg:prose-xl">
                <h2 class="card-title w-96 flex-1 prose">
                    <div>
                        @if ($currentIndex <= $size)
                            Question {{ $currentIndex + 1 }}
                        @else
                            Language:
                            <a href="{{ $languages[$result['language']]['infos'] }}" target="_blank" id="language">
                                {{ $result['language'] }}
                            </a>
                        @endif
                    </div>
                    <div wire:loading.delay role="status">
                        <svg aria-hidden="true"
                            class="mr-2 w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="currentColor" />
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="currentFill" />
                        </svg>
                    </div>
                </h2>
                @if ($currentIndex <= $size)
                    <p>{{ $questions[$currentIndex]['question'] }}</p>
                    <div class="form-control">
                        <label class="label cursor-pointer">
                            <span class="label-text text-xl">No</span>
                            <input @class([
                                'radio',
                                'checked:bg-red-500',
                                'input-error' => $errors->isNotEmpty(),
                            ]) wire:model.defer="answer" value="no" type="radio"
                                name="radio-10" />
                        </label>
                    </div>
                    <div class="form-control">
                        <label class="label cursor-pointer">
                            <span class="label-text text-xl">Yes</span>
                            <input @class([
                                'radio',
                                'checked:bg-blue-500',
                                'input-error' => $errors->isNotEmpty(),
                            ]) wire:model.defer="answer" value="yes" type="radio"
                                name="radio-10" />
                        </label>
                    </div>
                    <button wire:click="nextQuestion" class="btn btn-primary">Next</button>
                @else
                    <p class="w-96 prose">
                        {{ $languages[$result['language']]['description'] }}
                    </p>
                    <button wire:click="startOver" class="btn btn-primary">Start Over</button>
                @endif
            </div>
        </div>
    </div>

</div>
