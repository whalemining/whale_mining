import requests
from django.shortcuts import redirect
from django.contrib.auth import login
from django.contrib.auth.models import User
from django.http import JsonResponse
from django.views.generic import TemplateView, View
from django.conf import settings
from .models import *

def get_telegram_user_data(telegram_id):
    """Fetch user data from Telegram API using user ID."""
    url = f'https://api.telegram.org/bot{settings.TELEGRAM_BOT_TOKEN}/getChat'
    response = requests.get(url, params={'chat_id': telegram_id})
    return response.json()

def telegram_auth(request):
    """Authenticate users via Telegram without redirecting."""
    telegram_id = request.GET.get('telegram_id')  # You need to pass this from your frontend

    # Fetch user data from Telegram API
    telegram_data = get_telegram_user_data(telegram_id)

    if telegram_data.get('ok'):
        user_data = telegram_data['result']
        telegram_username = user_data['username']
        telegram_id = user_data['id']

        # Create or get the user based on Telegram info
        user, created = User.objects.get_or_create(username=telegram_username)

        # Optionally, update/create user profile
        UserProfile.objects.get_or_create(
            user=user, defaults={'telegram_username': telegram_username, 'telegram_id': telegram_id}
        )

        # Log the user in
        login(request, user)

        return redirect('index')  # Redirect to the main page after login
    else:
        return JsonResponse({'error': 'Authentication failed'}, status=401)

class TapCoinView(TemplateView):
    template_name = 'whale_app/index.html'  # Use your actual template path

    def get_context_data(self, **kwargs):
        """Provide context for the template."""
        context = super().get_context_data(**kwargs)
        if self.request.user.is_authenticated:
            coin, created = Coin.objects.get_or_create(user=self.request.user)
            context['coins'] = coin.coins
        else:
            context['coins'] = 0  # Default if the user is not authenticated
            # Here you might want to call your Telegram authentication logic.
            # For example:
            # return redirect('telegram_auth')  # If user is not authenticated, call Telegram authentication
        return context

    def post(self, request, *args, **kwargs):
        """Handle coin tap and increment logic."""
        if request.user.is_authenticated:
            coin, created = Coin.objects.get_or_create(user=request.user)
            coin.coins += 3
            coin.save()
            return JsonResponse({'coins': coin.coins})
        return JsonResponse({'error': 'User not authenticated'}, status=401)

class ClaimRewardView(View):
    """Class-based view to handle reward claim functionality."""

    def get(self, request, *args, **kwargs):
        """Allow the user to claim reward if enabled by admin."""
        if request.user.is_authenticated:
            try:
                reward = Reward.objects.get(user=request.user)
                if reward.reward_status:
                    # Logic for reward claim (e.g., mark reward as claimed, update user)
                    return JsonResponse({'message': 'Reward claimed'})
                else:
                    return JsonResponse({'message': 'Coming soon...'})
            except Reward.DoesNotExist:
                return JsonResponse({'error': 'Reward not found'}, status=404)
        return JsonResponse({'error': 'User not authenticated'}, status=401)

class RegisterWalletView(View):
    """Class-based view to handle wallet registration functionality."""

    def post(self, request, *args, **kwargs):
        """Register a wallet address, ensuring no duplicates."""
        if request.user.is_authenticated:
            wallet_address = request.POST.get('wallet_address')
            if WalletAddress.objects.filter(wallet_address=wallet_address).exists():
                return JsonResponse({'error': 'Wallet address already exists'}, status=400)
            wallet, created = WalletAddress.objects.get_or_create(
                user=request.user, defaults={'wallet_address': wallet_address}
            )
            return JsonResponse({'message': 'Wallet address registered successfully'})
        return JsonResponse({'error': 'User not authenticated'}, status=401)
