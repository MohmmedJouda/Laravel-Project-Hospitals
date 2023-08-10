<x-mail::message>
# Welcome in your cms Hospitals

Now you can manage your hospital.

<x-mail::button :url="'http://127.0.0.1:8000/admin/home'">
Go To Dashboard
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
