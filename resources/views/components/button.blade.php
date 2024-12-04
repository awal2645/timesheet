<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn !bg-primary-50 dark:!bg-primary-50 !hover:bg-primary-300 dark:!hover:bg-primary-300 !text-text-light dark:!text-text-dark whitespace-nowrap']) }}>
    {{ $slot }}
</button>


