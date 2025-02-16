<?php

namespace App\Http\Controllers\API\V1\Platform;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Tenant\Order\OrderService;
use Symfony\Component\HttpFoundation\Response;
use App\Factories\Tenant\PaymentCallbackFactory;
use App\Repositories\Tenant\Order\OrderTransactionRepository;

class PaymentWebhookController extends Controller
{
    use ApiResponse;
    protected $orderService;
    protected $orderTransactionRepository;

    public function __construct(OrderService $orderService, OrderTransactionRepository $orderTransactionRepository)
    {
        $this->orderService = $orderService;
        $this->orderTransactionRepository = $orderTransactionRepository;
    }

    public function paymentCallback(Request $request, $gateway)
    {
        try {
            $event = $request->all();
            $paymentTransaction = PaymentCallbackFactory::make($gateway);
            if ($event['data']['object']['object'] === 'payment_intent') {
                $transactionObject = $paymentTransaction->handleWebhook($event);
                $this->orderTransactionRepository->updateTransaction(
                    $transactionObject->transaction_id,
                    $transactionObject->order_id,
                    [
                        'status' => $transactionObject->status,
                        'response' => $transactionObject->response
                    ]
                );

                if ($transactionObject->status == 'succeeded') {
                    $this->orderService->updatePaymentStatusAsPaid($transactionObject->order_id);
                }

                return $this->successResponse($transactionObject, "Payment callback processed successfully!");
            }
        } catch (\Exception $e) {
            return $this->errorResponse("Oops! Something went wrong. " . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
