<?php
class SkinStatsForSharks extends SkinTemplate {
	public $skinname = 'statsforsharks';
	public $stylename = 'StatsForSharks';
	public $template = 'StatsForSharksTemplate';
	public $bannerImage = "";
	public $sharksInvolved = "";

	/**
	 * Initializes output page and sets up skin-specific parameters
	 * @param OutputPage $out Object to initialize
	 */
	public function initPage(OutputPage $out) {
		//print_r($out->getContext()->getTitle());
		parent::initPage($out);
		$out->addMeta('viewport', 'width=device-width, initial-scale=1');

		$has_mark = false;
		$has_lori = false;
		$has_kevin = false;
		$has_robert = false;
		$has_barb = false;

		$geter = function(OutputPage $output) {
			return $output->mCategories;
		};
		$property_getter = Closure::bind($geter, null, $out);
		$categories = $property_getter($out);

		$has_mark = $this->hasCategory($categories['normal'], 'Mark Cuban');
		$has_lori = $this->hasCategory($categories['normal'], 'Lori Greiner');
		$has_kevin = $this->hasCategory($categories['normal'], "Kevin O'Leary");
		$has_robert = $this->hasCategory($categories['normal'], 'Robert Herjavec');
		$has_barb = $this->hasCategory($categories['normal'], 'Barbara Corcoran');
		$has_daymond = $this->hasCategory($categories['normal'], 'Daymond John');

		if ($has_mark && $has_lori) {
			$this->bannerImage = 'https://www.statsforsharks.com/skins/StatsForSharks/images/banner-mark-lori.jpg';
			$this->sharksInvolved = "Mark Cuban & Lori Greiner";
		} else if ($has_mark && $has_kevin) {
			$this->bannerImage = 'https://www.statsforsharks.com/skins/StatsForSharks/images/banner-mark-kevin.jpg';
			$this->sharksInvolved = "Mark Cuban & Kevin O'Leary";
		} else if ($has_mark && $has_robert) {
			$this->bannerImage =  'https://www.statsforsharks.com/skins/StatsForSharks/images/banner-mark-robert.jpg';
			$this->sharksInvolved = "Mark Cuban & Robert Herjavec";
		} else if ($has_mark && $has_barb) {
			$this->bannerImage = 'https://www.statsforsharks.com/skins/StatsForSharks/images/banner-mark-barbara.jpg';
			$this->sharksInvolved = "Mark Cuban & Barbara Corcoran";
		} else if ($has_mark && $has_daymond) {
			$this->bannerImage = 'https://www.statsforsharks.com/skins/StatsForSharks/images/banner-mark-daymond.jpg';
			$this->sharksInvolved = "Mark Cuban & Daymond John";
		} else if ($has_lori && $has_robert) {
			$this->bannerImage = 'https://www.statsforsharks.com/skins/StatsForSharks/images/banner-lori-robert.jpg';
			$this->sharksInvolved = "Lori Greiner & Robert Herjavec";
		} else if ($has_lori && $has_kevin) {
			$this->bannerImage = 'https://www.statsforsharks.com/skins/StatsForSharks/images/banner-lori-kevin.jpg';
			$this->sharksInvolved = "Lori Greiner & Kevin O'Leary";
		} else if ($has_robert && $has_kevin) {
			$this->bannerImage = 'https://www.statsforsharks.com/skins/StatsForSharks/images/banner-robert-kevin.jpg';
			$this->sharksInvolved = "Robert Herjavec & Kevin O'Leary";
		} else if ($has_robert && $has_daymond) {
			$this->bannerImage = 'https://www.statsforsharks.com/skins/StatsForSharks/images/banner-robert-daymond.jpg';
			$this->sharksInvolved = "Robert Herjavec & Daymond John";
		} else if ($has_robert && $has_barb) {
			$this->bannerImage = 'https://www.statsforsharks.com/skins/StatsForSharks/images/banner-robert-barbara.jpg';
			$this->sharksInvolved = "Robert Herjavec & Barbara Corcoran";
		} else if ($has_lori) {
			$this->bannerImage = 'https://www.statsforsharks.com/skins/StatsForSharks/images/banner-lori-greiner-deal.jpg';
			$this->sharksInvolved = "Lori Greiner";
		} else if ($has_mark) {
			$this->bannerImage = 'https://www.statsforsharks.com/skins/StatsForSharks/images/banner-mark-cuban-deal.jpg';
			$this->sharksInvolved = "Mark Cuban";
		} else if ($has_kevin) {
			$this->bannerImage = 'https://www.statsforsharks.com/skins/StatsForSharks/images/banner-kevin-oleary-deal.jpg';
			$this->sharksInvolved = "Kevin O'Leary";
		} else if ($has_robert) {
			$this->bannerImage = 'https://www.statsforsharks.com/skins/StatsForSharks/images/banner-robert-herjavec-deal.jpg';
			$this->sharksInvolved = "Robert Herjavec";
		} else if ($has_barb) {
			$this->bannerImage = 'https://www.statsforsharks.com/skins/StatsForSharks/images/banner-barbara-corcoran-deal.jpg';
			$this->sharksInvolved = "Barbara Corcoran";
		} else if ($has_daymond) {
			$this->bannerImage = 'https://www.statsforsharks.com/skins/StatsForSharks/images/banner-daymond-john-deal.jpg';
			$this->sharksInvolved = "Daymond John";
		}

		if (strlen($this->bannerImage)) {
			$out->addMeta('og:image', $this->bannerImage);
			$out->addMeta('og:title', $out->getContext()->getTitle()->mTextform." - A ".$this->sharksInvolved." Deal");
		} else {
			$out->addMeta('og:title', $out->getContext()->getTitle()->mTextform." Summary & Charts");
		}
		$out->addMeta('og:url', $out->getContext()->getTitle()->getCanonicalURL());
		$out->addMeta('og:title', "Stats For Sharks");
		$out->addMeta('og:type', "article");
		//echo $out->getCanonicalUrl();

		//print_r($categories['normal']);
		//echo "Number of categories: ".sizeof($categories['normal']);
		$out->addModules( 'skins.statsforsharks.js' );
	}

	private function hasCategory($categories, $test) {
		for($i = 0; $i < sizeof($categories); $i++) {
			if (strpos($categories[$i], $test) !== false) return true;
		}
		return false;
	}

	/**
	 * Loads skin and user CSS files.
	 * @param OutputPage $out
	 */
	function setupSkinUserCss(OutputPage $out) {
		parent::setupSkinUserCss($out);

		$styles = ['mediawiki.skinning.interface', 'skins.statsforsharks.styles'];
		$out->addModuleStyles($styles);
	}
}
