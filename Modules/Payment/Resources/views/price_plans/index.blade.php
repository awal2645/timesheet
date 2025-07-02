@section('title')
    {{ __('Price Plans') }}
@endsection

<x-app-layout>
    <!-- Breadcrumb Navigation -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6 mt-6">
        <x-breadcrumb :items="[
            [
                'label' => __('Price Plans'),
                'icon' => true
            ]
        ]" />
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header Section -->
        <div class="bg-white dark:bg-slate-800 shadow-2xl rounded-3xl overflow-hidden border border-gray-200 dark:border-gray-700 mb-8">
            <div class="bg-gradient-to-r from-blue-50 to-indigo-100 dark:from-slate-700 dark:to-slate-800 px-8 py-8 border-b border-gray-200 dark:border-gray-600">
                <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between space-y-4 lg:space-y-0">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white flex items-center">
                            <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                </svg>
                            </div>
                            {{ __('Price Plans Management') }}
                        </h1>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Manage your pricing plans and subscription options') }}
                        </p>
                    </div>
        
        @canany('Plan create')
                    <div class="flex items-center space-x-4">
                        <div class="hidden md:flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400">
                            <span>{{ __('Total Plans') }}</span>
                            <div class="bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 px-3 py-1 rounded-full font-semibold">
                                {{ count($plans) }}
                            </div>
                        </div>
            <a href="{{ route('plans.create') }}" 
                           class="group inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-blue-500/50">
                            <div class="flex items-center justify-center w-5 h-5 bg-white/20 rounded-lg mr-2">
                                <svg class="w-3 h-3 transition-transform duration-200 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                            </div>
                {{ __('Create New Plan') }}
                            <svg class="w-4 h-4 ml-2 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5-5 5M6 12h12"/>
                            </svg>
            </a>
                    </div>
        @endcanany
                </div>
            </div>
    </div>

        <!-- Plans Grid -->
        @if(count($plans) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
        @foreach($plans as $plan)
            @if(auth()->user()->role === 'admin')
                <x-payment::components.admin-plan-card :plan="$plan" />
            @else
                <x-payment::components.employer-plan-card :plan="$plan" />
            @endif
        @endforeach
    </div>
        @else
        <!-- Empty State -->
        <div class="bg-white dark:bg-slate-800 shadow-2xl rounded-3xl overflow-hidden border border-gray-200 dark:border-gray-700">
            <div class="px-8 py-16 text-center">
                <div class="mx-auto w-24 h-24 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-12 h-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                    {{ __('No Price Plans Yet') }}
                </h3>
                <p class="text-gray-600 dark:text-gray-400 mb-8 max-w-md mx-auto">
                    {{ __('Get started by creating your first pricing plan. Define your services, set competitive prices, and start attracting customers.') }}
                </p>
                @canany('Plan create')
                <a href="{{ route('plans.create') }}" 
                   class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-blue-500/50">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    {{ __('Create Your First Plan') }}
                </a>
                @endcanany
            </div>
        </div>
        @endif

        <!-- Statistics Cards (if admin) -->
        @if(auth()->user()->role === 'admin' && count($plans) > 0)
        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Total Plans -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">{{ __('Total Plans') }}</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ count($plans) }}</p>
                    </div>
                </div>
            </div>

            <!-- Active Plans -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">{{ __('Active Plans') }}</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ count($plans) }}</p>
                    </div>
                </div>
            </div>

            <!-- Price Range -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">{{ __('Price Range') }}</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">
                            @if(count($plans) > 0)
                                ${{ number_format($plans->min('price'), 0) }} - ${{ number_format($plans->max('price'), 0) }}
                            @else
                                $0
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Help Section -->
        @if(count($plans) > 0)
        <div class="mt-12 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 border border-blue-200 dark:border-blue-800 rounded-2xl p-8">
            <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-blue-900 dark:text-blue-300 mb-2">
                        {{ __('Pricing Plan Tips') }}
                    </h3>
                    <div class="text-blue-800 dark:text-blue-400 space-y-2">
                        <p class="flex items-start">
                            <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            {{ __('Create tiered pricing to cater to different customer segments') }}
                        </p>
                        <p class="flex items-start">
                            <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            {{ __('Clearly define features and limitations for each plan') }}
                        </p>
                        <p class="flex items-start">
                            <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            {{ __('Consider offering annual discounts to increase customer retention') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @endif
</div>

@push('scripts')
<script>
    function showConfirmation(planId) {
            // Create custom confirmation modal
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
            modal.innerHTML = `
                <div class="bg-white dark:bg-slate-800 rounded-2xl p-8 max-w-md mx-4 shadow-2xl">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ __('Confirm Deletion') }}</h3>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400 mb-8">{{ __('Are you sure you want to delete this plan? This action cannot be undone.') }}</p>
                    <div class="flex space-x-4">
                        <button onclick="cancelDeletion()" class="flex-1 px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors">
                            {{ __('Cancel') }}
                        </button>
                        <button onclick="confirmDeletion(${planId})" class="flex-1 px-4 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors">
                            {{ __('Delete Plan') }}
                        </button>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);
        }

        function cancelDeletion() {
            const modal = document.querySelector('.fixed.inset-0');
            if (modal) {
                modal.remove();
            }
        }

        function confirmDeletion(planId) {
            document.getElementById('delete-form-' + planId).submit();
        }

        // Add smooth animations for plan cards
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('[class*="grid"] > div');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.6s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
</script>
@endpush
</x-app-layout>