<?php
namespace KVZ\Laravel\Yunpian;


use SmsOperator;

class YunpianService
{
    /**
     * @var SmsOperator
     */
    private $smsOperator;

    public function __construct()
    {
        $this->smsOperator = new SmsOperator(env('YUNPIAN_API_KEY'));
    }

    public function smsSingleSend($mobile, $text)
    {
        $data['mobile'] = $mobile;
        $data['text'] = $text;
        $result = $this->smsOperator->single_send($data);
        return $this->makeResult($result);
    }

    public function smsBatchSendSameText($mobiles, $text)
    {
        // 发送批量短信，批量发送的接口耗时比单号码发送长，
        // 如果需要更高并发速度，推荐使用single_send/tpl_single_send
        $data['mobile'] = implode($mobiles, ',');
        $data['text'] = $text;
        $result = $this->smsOperator->batch_send($data);
        return $this->makeResult($result);
    }

    public function smsBatchSendDifferentTexts($mobiles, $texts)
    {
        // 这个是个性化接口发送，批量发送的接口耗时比单号码发送长，
        // 如果需要更高并发速度，推荐使用single_send/tpl_single_send，不推荐使用
        $data['mobile'] = implode($mobiles, ',');
        $data['text'] = implode($texts, ',');
        $result = $this->smsOperator->multi_send($data);
        return $this->makeResult($result);
    }

    /**
     * @param $result
     * @return array
     */
    protected function makeResult($result)
    {
        return [
            'success' => $result->isSuccess(),
            'info'    => $result->responseData['msg'],
        ];
    }
}