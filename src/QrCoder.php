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


	/** @var int ~ Error correction level. */
	protected $ecLevel;


	/**
	 * @param int $ecLevel ~ Error correction level.
	 */
	public function __construct($ecLevel = self::EC_LEVEL_L) {
		$this->ecLevel = $ecLevel;
	}


	/**
	 * Set error correction level.
	 *
	 * @param $ecLevel ~ Error correction level.
	 * @return void
	 */
	public function setErrorCorrectionLevel($ecLevel) {
		$this->ecLevel = $ecLevel;
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
			$ecLevel = $this->ecLevel;
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
 * Exception thrown when encoding error occures
 */
class QrCoderException extends Exception { }
