<?php

namespace com\peterbodnar\qrcoder;

use BaconQrCode\Common\ErrorCorrectionLevel as BaconQrECLevel;
use BaconQrCode\Encoder\Encoder as BaconQrEncoder;
use com\peterbodnar\mx\IMatrix;



/**
 * Data to qr-code matrix encoder
 */
class QrCoder {


	/** Level L, ~7% correction. */
	const EC_LEVEL_L = BaconQrECLevel::L;
	/** Level M, ~15% correction. */
	const EC_LEVEL_M = BaconQrECLevel::M;
	/** Level Q, ~25% correction. */
	const EC_LEVEL_Q = BaconQrECLevel::Q;
	/** Level H, ~30% correction. */
	const EC_LEVEL_H = BaconQrECLevel::H;


	/** @var int */
	protected $defaultEcLevel;


	/**
	 * @param int $defaultEcLevel
	 */
	public function __construct($defaultEcLevel = self::EC_LEVEL_L) {
		$this->defaultEcLevel = $defaultEcLevel;
	}


	/**
	 * Encode data to qr-code matrix.
	 *
	 * @param string $data ~ Data to encode.
	 * @param int|null $ecLevel ~ Error correction level.
	 * @return IMatrix
	 * @throws QrCoderException
	 */
	public function encode($data, $ecLevel = NULL) {
		if (NULL === $ecLevel) {
			$ecLevel = $this->defaultEcLevel;
		}
		try {
			$qrCode = BaconQrEncoder::encode($data, new BaconQrECLevel($ecLevel, TRUE));
			return new MatrixAdapter($qrCode->getMatrix());
		} catch (\Exception $ex) {
			throw new QrCoderException("Error encoding data: " . $ex->getMessage(), 0, $ex);
		}
	}

}



/**
 * Class QrEncoderException
 */
class QrCoderException extends Exception { }
